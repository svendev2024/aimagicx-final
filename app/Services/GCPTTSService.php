<?php

namespace App\Services;

use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SsmlVoiceGender;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;
use Spatie\Backup\Helpers\Backup;
use App\Services\Statistics\UserService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Voice;
use Exception;

class GCPTTSService 
{

    private $client;
    private $api;

    /**
     * Initialize GCP client
     *
     * 
     */
    public function __construct()
    {
        $this->api = new UserService();

        $verify = $this->api->verify_license();

        if($verify['status']!=true){
            return false;
        }

        try {

            if (config('services.gcp.key_path')) {
                $credentials = config('services.gcp.key_path');

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_URL, $credentials);
                $contents = curl_exec($curl);
                curl_close($curl);

                $this->client = new TextToSpeechClient([
                    'credentials' => json_decode($contents, true),
                ]);  
            }
                     

        } catch (Exception $e) {
            return response()->json(["exception" => "Credentials are incorrect. Please notify support team."], 422);
            Log::error($e->getMessage());
        }
    }


    /**
     * Synthesize text less than 5000 characters
     *
     * @return result link 
     */
    public function synthesizeSpeech(Voice $voice, $text, $format, $file_name)
    {   

        $text = preg_replace("/\&/", "&amp;", $text);
        $text = preg_replace("/(^|(?<=\s))<((?=\s)|$)/i", "&lt;", $text);
        $text = preg_replace("/(^|(?<=\s))>((?=\s)|$)/i", "&gt;", $text);

        $ssml_text = '<speak>' . $text . '</speak>'; 
        switch ($format) {
            case 'mp3':
                $audio_encoding = AudioEncoding::MP3;
                break;
            case 'wav':
                $audio_encoding = AudioEncoding::LINEAR16;
                break;
            case 'ogg':
                $audio_encoding = AudioEncoding::OGG_OPUS;
                break;
            default:
                $audio_encoding = AudioEncoding::MP3;
                break;
        }   
        
        $input_text = (new SynthesisInput())
                    ->setSsml($ssml_text);

        $input_voice = (new VoiceSelectionParams())
                    ->setLanguageCode($voice->language_code)
                    ->setName($voice->voice_id);
        
        $audio_config = (new AudioConfig())
                    ->setAudioEncoding($audio_encoding);
        
        $response = $this->client->synthesizeSpeech($input_text, $input_voice, $audio_config);
        $audio_stream = $response->getAudioContent();        

        $backup = new Backup();
        $upload = $backup->upload();
        if (!$upload['status']) { return false; }

        Storage::disk('audio')->put($file_name, $audio_stream); 

        $data['result_url'] = Storage::url($file_name); 
        $data['name'] = $file_name;
        
        return $data;
    }
    
    


}