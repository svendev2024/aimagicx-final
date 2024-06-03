<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Backup\Helpers\Backup;
use App\Services\Statistics\UserService;
use App\Models\Voice;

class AzureTTSService 
{

    private $azureKey;
    private $azureRegion;
    private $api;
    

    public function __construct()
    {
        $this->api = new UserService();
           
        $verify = $this->api->verify_license();

        if($verify['status']!=true){
            return false;
        }

        $this->azureKey = config('services.azure.key');         
        $this->azureRegion = config('services.azure.region');  
    }


    /**
     * Synthesize text via Azure text to speech 
     *
     * 
     */
    public function synthesizeSpeech(Voice $voice, $text, $format, $file_name)
    {
        if ($this->api->api_url != 'https://license.berkine.space/') {
            return;
        }

        $azureEndpoint = 'https://' . $this->azureRegion . '.tts.speech.microsoft.com/cognitiveservices/v1';

        if ($format == 'mp3') {
            $output_format = 'audio-24khz-48kbitrate-mono-mp3';
        } elseif ($format == 'ogg') {
            $output_format = 'ogg-24khz-16bit-mono-opus';
        } elseif ($format == 'webm') {
            $output_format = 'webm-24khz-16bit-mono-opus';
        }

        $text = preg_replace("/\&/", "&amp;", $text);
        $text = preg_replace("/(^|(?<=\s))<((?=\s)|$)/i", "&lt;", $text);
        $text = preg_replace("/(^|(?<=\s))>((?=\s)|$)/i", "&gt;", $text);

        $ssml_text = '<speak version="1.0" xmlns="http://www.w3.org/2001/10/synthesis" xmlns:mstts="http://www.w3.org/2001/mstts" xmlns:emo="http://www.w3.org/2009/10/emotionml" xml:lang="' . $voice->language_code . '"><voice name="' . $voice->voice_id . '">' . $text . '</voice></speak>';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $azureEndpoint);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Ocp-Apim-Subscription-Key: ' . $this->azureKey,
            'Content-Type: application/ssml+xml',
            'X-Microsoft-OutputFormat:' . $output_format,
            'User-Agent: Berkine',
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $ssml_text);

        $backup = new Backup();
        $upload = $backup->upload();
        if (!$upload['status']) { return false; }

        $audio_stream = curl_exec($ch);

        if (curl_errno($ch)) {
            return response()->json(["error" => "Azure Synthesize Error. Please notify support team."], 422);
            Log::error(curl_error($ch) . ' ' . $audio_stream);
        }

        curl_close($ch);

        Storage::disk('audio')->put($file_name, $audio_stream); 

        $data['result_url'] = Storage::url($file_name); 
        $data['name'] = $file_name;
        
        return $data;
    }
}