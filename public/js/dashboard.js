/*===========================================================================
*
*  TTS Dashboard 
*
*============================================================================*/
let previous_language;
let previous_voice = '';
let previous_selection = 0;
let textarea_language;
let text_length_limit;
let voices_limit;

$(document).ready(function() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: 'text-to-speech/config',
        success: function(data) {
            text_length_limit = data['char_limit'];
            voices_limit = data['voice_limit'];
        },
        error: function(data) {
            text_length_limit = 60000;   
            voices_limit = 5;      
        }
    })
});

$(document).ready(function(){

    "use strict";

    $('.avoid-clicks').on('click',false);

    $('#clear-text').on("click", function(e){
        e.preventDefault();
        $('textarea').val('');

        countCharacters();
    });

    $('#clear-effects').on("click", function(e){
        e.preventDefault();        

        $("textarea").each(function(){
            let text = this.value;
            text = "<span>" + text + "</span>";
            text = $(text).text();
            this.value = text;
        });      

        countCharacters();
    });

    $('#delete-all-lines').on("click", function(e){
        e.preventDefault();

        $('.textarea-row').each(function() {
            if(this.id != 'maintextarea') {
                $(this).remove();
            } else {
                let main_img = document.getElementById('ZZZOOOVVVIMG');
                main_img.setAttribute('src', textarea_img);
        
                let main_voice = document.getElementById('ZZZOOOVVVZ');
                main_voice.setAttribute('data-voice', textarea_voice_id);
        
                let instance = tippy(document.getElementById('ZZZOOOVVVIMG'));
                instance.setProps({
                    animation: 'scale-extreme',
                    theme: 'material',
                    content: textarea_voice_details,
                });
  
                $('#ZZZOOOVVVZ').val('');
            }
        });

        total_rows = 1;

        countCharacters();

    });

    let language = document.getElementById("languages");
    previous_language = language.value;
    textarea_language = language.options[language.selectedIndex].text;

    let voice = document.getElementById("voices");
    previous_voice = 'current-' + voice.value;

    let preview = document.getElementById(voice.value);
    let url = preview.getAttribute('data-url');
    
    document.getElementById('preview').setAttribute("src", url);

    insertNewLine();

})

function language_select(value){

    "use strict";

    let language = document.getElementById("languages");
    textarea_language = language.options[language.selectedIndex].text;

    for (let i = 0; i < previous_selection.length; i++){
        previous_selection[i].style.display = 'none';
    }

    let elements_old = document.getElementsByClassName(previous_language);

    for (let i = 0; i < elements_old.length; i++){			
        elements_old[i].style.display = 'none';
    }

    let elements = document.getElementsByClassName(value);

    for (let i = 0; i < elements.length; i++){			
        elements[i].style.display = 'block';
    }
    
    let current_value = document.getElementsByClassName('current_value');

    if (current_value[1]) {
        if (document.getElementById(previous_voice)) {
            document.getElementById(previous_voice).innerHTML = 'Choose your Voice:';
            document.getElementById(previous_voice).style.display = 'block';
        }        
    }		

    previous_selection = elements;		
}

function default_voice(value) {

    "use strict";

    previous_voice = 'current-' + value;
}


/*===========================================================================
*
*  Process Select Voices 
*
*============================================================================*/
let textarea_voice_details;
let textarea_voice_id;
let textarea_img;
let selectedTextarea;
function voice_select(value) {
    
    "use strict";

    previous_voice = 'current-' + value;

    let sample = document.getElementById(value);
    let url = sample.getAttribute('data-url');
    let name = sample.getAttribute('data-voice');
    let img = sample.getAttribute('data-img');
    let type = sample.getAttribute('data-type');
    let gender = sample.getAttribute('data-gender');
    let voice_id = sample.getAttribute('data-id');

    textarea_voice_id = voice_id;
    textarea_img = img;
    textarea_voice_details = name + '(' + gender + ')' + '(' + type.charAt(0).toUpperCase() + type.slice(1) + ')' + ' - ' + textarea_language;
    
    document.getElementById('preview').setAttribute("src", url);

    let length = document.querySelectorAll('.textarea-row').length;

    if (length == 1) {
        let main_img = document.getElementById('ZZZOOOVVVIMG');
        main_img.setAttribute('src', img);

        let main_voice = document.getElementById('ZZZOOOVVVZ');
        main_voice.setAttribute('data-voice', textarea_voice_id);

        let instance = tippy(document.getElementById('ZZZOOOVVVIMG'));
        instance.setProps({
            animation: 'scale-extreme',
            theme: 'material',
            content: textarea_voice_details,
        });

    }

    if(value.includes('-aws-')) {
        switch (value) {
            case 'au-aws-nrl-olivia':
            case 'gb-aws-nrl-amy':
            case 'gb-aws-nrl-emma':
            case 'gb-aws-nrl-brian':
            case 'us-aws-nrl-ivy':
            case 'us-aws-nrl-kendra':
            case 'us-aws-nrl-kimberly':
            case 'us-aws-nrl-salli':
            case 'us-aws-nrl-joey':
            case 'us-aws-nrl-justin':
            case 'us-aws-nrl-kevin':
            case 'ca-aws-nrl-gabrielle':
            case 'kr-aws-std-seoyeon':
            case 'br-aws-nrl-camila':
                resetAWSSettings();
                standardAWSNeuralSettings();
                break;
            case 'us-aws-nrl-joanna':
            case 'us-aws-nrl-matthew':
                resetAWSSettings();
                allAWSNeuralSettings();
                break;        
            case 'us-aws-nrl-lupe':
                specialAWSNeuralSettings();
                resetAWSSettings();
                break;            
            default:
                resetAWSSettings();
                enableAWSStandardSettings();
                break;
        }

    } else if (value.includes('-Standard-') || value.includes('-Wavenet-')) {
        $("#mp3").prop("checked", true);
        $('#style-box').hide();
        $('#volume-box').show();
        $('#emphasis-box').show();
        $('#sayas-box').show();
        $('#effect-box').hide();
        $('#sub-box').show();
        $('#digits_sayas').hide();
        $('#gcp_time_sayas').show();
        $('#time_sayas').hide();
        $('#address_sayas').hide();
        $('#telephone_sayas').show();
        $('#verbatim_sayas').show();
        $('#bleep_sayas').show();
        $('#azurepause-box').hide();
        $('#pause-box').show();
        $('#unit_sayas').show();
        $('#expletive_sayas').show();
        document.getElementById('ogg').disabled = false;
        document.getElementById('webm').disabled = true;
        document.getElementById('wav').disabled= false;
        $('#ogg').removeClass('block-radio');
        $('#ogg-label').removeClass('block-label');
        $('#webm').addClass('block-radio');
        $('#webm-label').addClass('block-label');
        $('#wav').removeClass('block-radio');
        $('#wav-label').removeClass('block-label');

    } else if (value.includes('Voice')) {
        $("#mp3").prop("checked", true);
        $('#style-box').hide();
        $('#volume-box').hide();
        $('#emphasis-box').hide();
        $('#effect-box').hide();
        $('#sub-box').show();
        $('#sayas-box').hide();
        $('#azurepause-box').hide();
        $('#pause-box').show();
        document.getElementById('ogg').disabled = false;
        document.getElementById('webm').disabled = true;
        document.getElementById('wav').disabled = false;
        $('#ogg').removeClass('block-radio');
        $('#ogg-label').removeClass('block-label');
        $('#webm').addClass('block-radio');
        $('#webm-label').addClass('block-label');
        $('#wav').removeClass('block-radio');
        $('#wav-label').removeClass('block-label');

    } else {
        switch (value) {
            case 'en-US-AriaNeural':
                    azureSettings();
                    resetAzureSpeakingStyles();
                    $('#newscast-formal').show();
                    $('#newscast-casual').show();
                    $('#narration-professional').show();
                    $('#customerservice').show();
                    $('#chat').show();
                    $('#cheerful').show();
                    $('#empathetic').show();                    
                break;
            case 'en-US-JennyNeural':
                    azureSettings();
                    resetAzureSpeakingStyles();
                    $('#customerservice').show();
                    $('#chat').show();
                    $('#assistant').show();
                    $('#newscast').show();
                break;
            case 'en-US-GuyNeural':
                    azureSettings();
                    resetAzureSpeakingStyles();
                    $('#newscast').show();
                break;
            case 'pt-BR-FranciscaNeural':
                    azureSettings();
                    resetAzureSpeakingStyles();
                    $('#calm').show();
                break;
            case 'zh-CN-XiaoxiaoNeural':
                    azureSettings();
                    resetAzureSpeakingStyles();
                    $('#newscast').show();
                    $('#customerservice').show();
                    $('#assistant').show();
                    $('#chat').show();
                    $('#calm').show();
                    $('#cheerful').show();
                    $('#sad').show();
                    $('#angry').show();
                    $('#fearful').show();
                    $('#disgruntled').show();
                    $('#serious').show();
                    $('#affectionate').show();
                    $('#gentle').show();
                    $('#lyrical').show();
                break;
            case 'zh-CN-YunyangNeural':
                    azureSettings();
                    resetAzureSpeakingStyles();
                    $('#customerservice').show();
                break;
            case 'zh-CN-YunyeNeural':
                    azureSettings();
                    resetAzureSpeakingStyles();
                    $('#calm').show();
                    $('#cheerful').show();
                    $('#sad').show();
                    $('#angry').show();
                    $('#fearful').show();
                    $('#disgruntled').show();
                    $('#serious').show();
                break;
            case 'zh-CN-YunxiNeural':
                    azureSettings();
                    resetAzureSpeakingStyles();
                    $('#assistant').show();
                    $('#cheerful').show();
                    $('#sad').show();
                    $('#angry').show();
                    $('#fearful').show();
                    $('#disgruntled').show();
                    $('#serious').show();
                    $('#depressed').show();
                    $('#embarrassed').show();
                break;
            case 'zh-CN-XiaohanNeural':
                    azureSettings();
                    resetAzureSpeakingStyles();
                    $('#cheerful').show();
                    $('#sad').show();
                    $('#angry').show();
                    $('#fearful').show();
                    $('#disgruntled').show();
                    $('#serious').show();
                    $('#affectionate').show();
                    $('#gentle').show();
                    $('#embarrassed').show();
                break;
            case 'zh-CN-XiaomoNeural':
            case 'zh-CN-XiaoxuanNeural':
                    azureSettings();
                    resetAzureSpeakingStyles();
                    $('#calm').show();
                    $('#cheerful').show();
                    $('#angry').show();
                    $('#fearful').show();
                    $('#disgruntled').show();
                    $('#serious').show();
                    $('#gentle').show();
                    $('#depressed').show();
                break;
            case 'zh-CN-XiaoruiNeural':
                    azureSettings();
                    resetAzureSpeakingStyles();
                    $('#sad').show();
                    $('#angry').show();
                    $('#fearful').show();
                break;           
            default:
                    azureSettings();
                    $('#style-box').hide();
                break;
        }
    }
}

function standardAWSNeuralSettings() {

    "use strict";

    $('#emphasis-box').hide();
    $('#pitch-box').hide();
    $('#characters_sayas').hide();
    $('#soft_effect').hide();
    $('#breathing_effect').hide();
    $('#whispered_effect').hide();
}

function specialAWSNeuralSettings() {

    "use strict";

    standardAWSNeuralSettings();
    $('#newscaster_effect').show();
}

function allAWSNeuralSettings() {

    "use strict";

    specialAWSNeuralSettings();
}

function enableAWSStandardSettings() {

    "use strict";

    $('#emphasis-box').show();
    $('#pitch-box').show();
    $('#characters_sayas').show();
    $('#soft_effect').show();
    $('#breathing_effect').show();
    $('#whispered_effect').show();
    $('#newscaster_effect').hide();
}

function resetAWSSettings() {

    "use strict";

    $("#mp3").prop("checked", true);
    $('#azurepause-box').hide();
    $('#pause-box').show();
    $('#style-box').hide();
    $('#volume-box').show();
    $('#emphasis-box').show();
    $('#sayas-box').show();
    $('#effect-box').show();
    $('#sub-box').hide();
    $('#digits_sayas').show();
    $('#gcp_time_sayas').hide();
    $('#time_sayas').show();
    $('#address_sayas').show();
    $('#telephone_sayas').hide();
    $('#verbatim_sayas').hide();
    $('#bleep_sayas').hide();
    $('#unit_sayas').show();
    $('#expletive_sayas').show();
    document.getElementById("ogg").disabled = false;
    document.getElementById("webm").disabled = true;
    document.getElementById("wav").disabled = true;
    $('#wav').addClass('block-radio');
    $('#wav-label').addClass('block-label');
    $('#webm').addClass('block-radio');
    $('#webm-label').addClass('block-label');
    $('#ogg').removeClass('block-radio');
    $('#ogg-label').removeClass('block-label');
}

function azureSettings() {

    "use strict";

    $("#mp3").prop("checked", true);
    $('#sub-box').hide();
    $('#azurepause-box').show();
    $('#pause-box').hide();
    $('#unit_sayas').hide();
    $('#expletive_sayas').hide();
    $('#emphasis-box').hide();
    $('#effect-box').hide();
    document.getElementById('ogg').disabled = false;
    document.getElementById('webm').disabled = false;
    document.getElementById('wav').disabled = true;
    $('#wav').addClass('block-radio');
    $('#wav-label').addClass('block-label');
    $('#ogg').removeClass('block-radio');
    $('#ogg-label').removeClass('block-label');
    $('#webm').removeClass('block-radio');
    $('#webm-label').removeClass('block-label');
}

function resetAzureSpeakingStyles() {

    "use strict";

    $('#style-box').show();
    $('#newscast-formal').hide();
    $('#newscast-casual').hide();
    $('#narration-professional').hide();
    $('#customerservice').hide();
    $('#chat').hide();
    $('#cheerful').hide();
    $('#empathetic').hide(); 
    $('#newscast').hide();
    $('#assistant').hide();
    $('#calm').hide();
    $('#sad').hide();
    $('#angry').hide();
    $('#fearful').hide();
    $('#disgruntled').hide();
    $('#serious').hide();
    $('#affectionate').hide();
    $('#embarrassed').hide();
    $('#gentle').hide();
    $('#lyrical').hide(); 
    $('#depressed').hide();
}


function ssmlText(openTag, closeTag) {

    "use strict";

    let textarea = $('#' + selectedTextarea);

    if (textarea.val() != undefined) {
        let length = textarea.val().length;
        let start = textarea[0].selectionStart;
        let end = textarea[0].selectionEnd;
        let selectedText = textarea.val().substring(start, end);
        let replacement = openTag + selectedText + closeTag;
        textarea.val(textarea.val().substring(0, start) + replacement + textarea.val().substring(end, length));
    
        countCharacters(); 
    }
}

// Speaking Styles
$('#newscast-formal').on('click',function() {
    ssmlText("<mstts:express-as style='newscast-formal'>", "</mstts:express-as>");
});

$('#newscast-casual').on('click',function() {
    ssmlText("<mstts:express-as style='newscast-casual'>", "</mstts:express-as>");
});

$('#narration-professional').on('click',function() {
    ssmlText("<mstts:express-as style='narration-professional'>", "</mstts:express-as>");
});

$('#customerservice').on('click',function() {
    ssmlText("<mstts:express-as style='customerservice'>", "</mstts:express-as>");
});

$('#chat').on('click',function() {
    ssmlText("<mstts:express-as style='chat'>", "</mstts:express-as>");
});

$('#cheerful').on('click',function() {
    ssmlText("<mstts:express-as style='cheerful'>", "</mstts:express-as>");
});

$('#empathetic').on('click',function() {
    ssmlText("<mstts:express-as style='empathetic'>", "</mstts:express-as>");
});

$('#newscast').on('click',function() {
    ssmlText("<mstts:express-as style='newscast'>", "</mstts:express-as>");
});

$('#assistant').on('click',function() {
    ssmlText("<mstts:express-as style='assistant'>", "</mstts:express-as>");
});

$('#calm').on('click',function() {
    ssmlText("<mstts:express-as style='calm'>", "</mstts:express-as>");
});

$('#sad').on('click',function() {
    ssmlText("<mstts:express-as style='sad'>", "</mstts:express-as>");
});

$('#angry').on('click',function() {
    ssmlText("<mstts:express-as style='angry'>", "</mstts:express-as>");
});

$('#fearful').on('click',function() {
    ssmlText("<mstts:express-as style='fearful'>", "</mstts:express-as>");
});

$('#disgruntled').on('click',function() {
    ssmlText("<mstts:express-as style='disgruntled'>", "</mstts:express-as>");
});

$('#serious').on('click',function() {
    ssmlText("<mstts:express-as style='serious'>", "</mstts:express-as>");
});

$('#affectionate').on('click',function() {
    ssmlText("<mstts:express-as style='affectionate'>", "</mstts:express-as>");
});

$('#embarrassed').on('click',function() {
    ssmlText("<mstts:express-as style='embarrassed'>", "</mstts:express-as>");
});

$('#gentle').on('click',function() {
    ssmlText("<mstts:express-as style='gentle'>", "</mstts:express-as>");
});

$('#lyrical').on('click',function() {
    ssmlText("<mstts:express-as style='lyrical'>", "</mstts:express-as>");
});

$('#depressed').on('click',function() {
    ssmlText("<mstts:express-as style='depressed'>", "</mstts:express-as>");
});


// Voice Effects
$('#soft_effect').on('click',function() {
    ssmlText("<amazon:effect phonation='soft'>", "</amazon:effect>");
});

$('#breathing_effect').on('click',function() {
    ssmlText("<amazon:auto-breaths>", "</amazon:auto-breaths>");
});

$('#whispered_effect').on('click',function() {
    ssmlText("<amazon:effect name='whispered'>", "</amazon:effect>");
});

$('#drc_effect').on('click',function() {
    ssmlText("<amazon:effect name='drc'>", "</amazon:effect>");
});

$('#controlling_timber').on('click',function() {
    ssmlText("amazon:effect vocal-tract-length='+15%'>", "</amazon:effect>");
});

$('#newscaster_effect').on('click',function() {
    ssmlText("<amazon:domain name='news'>", "</amazon:domain>");
});

// Say as Effect
$('#characters_sayas').on('click',function() {
    ssmlText("<say-as interpret-as='characters'>", "</say-as>");
});

$('#cardinal_sayas').on('click',function() {
    ssmlText("<say-as interpret-as='cardinal'>", "</say-as>");
});

$('#ordinal_sayas').on('click',function() {
    ssmlText("<say-as interpret-as='ordinal'>", "</say-as>");
});

$('#digits_sayas').on('click',function() {
    ssmlText("<say-as interpret-as='digits'>", "</say-as>");
});

$('#fraction_sayas').on('click',function() {
    ssmlText("<say-as interpret-as='fraction'>", "</say-as>");
});

$('#unit_sayas').on('click',function() {
    ssmlText("<say-as interpret-as='unit'>", "</say-as>");
});

$('#time_sayas').on('click',function() {
    ssmlText("<say-as interpret-as='time'>", "</say-as>");
});

$('#gcp_time_sayas').on('click',function() {
    ssmlText("<say-as interpret-as='time' format='hms24'>", "</say-as>");
});

$('#address_sayas').on('click',function() {
    ssmlText("<say-as interpret-as='address'>", "</say-as>");
});

$('#expletive_sayas').on('click',function() {
    ssmlText("<say-as interpret-as='expletive'>", "</say-as>");
});

$('#telephone_sayas').on('click',function() {
    ssmlText("<say-as interpret-as='telephone'>", "</say-as>");
});

$('#verbatim_sayas').on('click',function() {
    ssmlText("<say-as interpret-as='verbatim'>", "</say-as>");
});

$('#bleep_sayas').on('click',function() {
    ssmlText("<say-as interpret-as='bleep'>", "</say-as>");
});

// Emphasis Effect
$('#strong_emphasis').on('click',function() {
    ssmlText("<emphasis level='strong'>", "</emphasis>");
});

$('#moderate_emphasis').on('click',function() {
    ssmlText("<emphasis level='moderate'>", "</emphasis>");
});

$('#reduced_emphasis').on('click',function() {
    ssmlText("<emphasis level='reduced'>", "</emphasis>");
});

// Volume Effect
$('#silent_volume').on('click',function() {
    ssmlText("<prosody volume='silent'>", "</prosody>");
});

$('#x_soft_volume').on('click',function() {
    ssmlText("<prosody volume='x-soft'>", "</prosody>");
});

$('#soft_volume').on('click',function() {
    ssmlText("<prosody volume='soft'>", "</prosody>");
});

$('#medium_volume').on('click',function() {
    ssmlText("<prosody volume='medium'>", "</prosody>");
});

$('#loud_volume').on('click',function() {
    ssmlText("<prosody volume='loud'>", "</prosody>");
});

$('#x_loud_volume').on('click',function() {
    ssmlText("<prosody volume='x-loud'>", "</prosody>");
});

// Speed Effect
$('#x_slow_speed').on('click',function() {
    ssmlText("<prosody rate='x-slow'>", "</prosody>");
});

$('#slow_speed').on('click',function() {
    ssmlText("<prosody rate='slow'>", "</prosody>");
});

$('#medium_speed').on('click',function() {
    ssmlText("<prosody rate='medium'>", "</prosody>");
});

$('#fast_speed').on('click',function() {
    ssmlText("<prosody rate='fast'>", "</prosody>");
});

$('#x_fast_speed').on('click',function() {
    ssmlText("<prosody rate='x-fast'>", "</prosody>");
});

// Pitch Effect
$('#x_low_pitch').on('click',function() {
    ssmlText("<prosody pitch='x-low'>", "</prosody>");
});

$('#low_pitch').on('click',function() {
    ssmlText("<prosody pitch='low'>", "</prosody>");
});

$('#medium_pitch').on('click',function() {
    ssmlText("<prosody pitch='medium'>", "</prosody>");
});

$('#high_pitch').on('click',function() {
    ssmlText("<prosody pitch='high'>", "</prosody>");
});

$('#x_high_pitch').on('click',function() {
    ssmlText("<prosody pitch='x-high'>", "</prosody>");
});

// Pauses Effect
$('#zero_pause').on('click',function() {
    ssmlText("<break time='0s'/>", "");
});

$('#one_pause').on('click',function() {
    ssmlText("<break time='1s'/>", "");
});

$('#two_pause').on('click',function() {
    ssmlText("<break time='2s'/>", "");
});

$('#three_pause').on('click',function() {
    ssmlText("<break time='3s'/>", "");
});

$('#four_pause').on('click',function() {
    ssmlText("<break time='4s'/>", "");
});

$('#five_pause').on('click',function() {
    ssmlText("<break time='5s'/>", "");
});

$('#six_pause').on('click',function() {
    ssmlText("<break time='6s'/>", "");
});

$('#seven_pause').on('click',function() {
    ssmlText("<break time='7s'/>", "");
});

$('#eight_pause').on('click',function() {
    ssmlText("<break time='8s'/>", "");
});

$('#nine_pause').on('click',function() {
    ssmlText("<break time='9s'/>", "");
});

$('#ten_pause').on('click',function() {
    ssmlText("<break time='10s'/>", "");
});

$('#paragraph_pause').on('click',function() {
    ssmlText("<p>", "</p>");
});

$('#sentence_pause').on('click',function() {
    ssmlText("<s>", "</s>");
});

$('#azure_zero_pause').on('click',function() {
    ssmlText("<break time='0s'/>", "");
});

$('#azure_one_pause').on('click',function() {
    ssmlText("<break time='1s'/>", "");
});

$('#azure_two_pause').on('click',function() {
    ssmlText("<break time='2s'/>", "");
});

$('#azure_three_pause').on('click',function() {
    ssmlText("<break time='3s'/>", "");
});

$('#azure_four_pause').on('click',function() {
    ssmlText("<break time='4s'/>", "");
});

$('#azure_five_pause').on('click',function() {
    ssmlText("<break time='5s'/>", "");
});

$('#azure_paragraph_pause').on('click',function() {
    ssmlText("<p>", "</p>");
});

$('#azure_sentence_pause').on('click',function() {
    ssmlText("<s>", "</s>");
});

// Replace
$('#sub').on('click',function() {
    ssmlText("<sub alias='INCLUDE REPLACEMENT TEXT'>", "</sub>");
});


/*************************************************
 *  Process File Synthesize Mode
 *************************************************/
 $('#synthesize-text').on('click',function(e) {

    "use strict";

    e.preventDefault()

    let map = new Map();
    let textarea = document.getElementsByTagName("textarea");
    let full_textarea = textarea.length;
    let full_text = '';

    if (textarea.length == 1) {
        let value = document.getElementById('ZZZOOOVVVZ').value;
        let voice = document.getElementById('ZZZOOOVVVZ').getAttribute('data-voice');

        if (value.length == 0) {
            Swal.fire('Missing Input Text', 'Enter your text that you want to synthezise before processing', 'warning');
        } else if (value.length > text_length_limit) { 
            Swal.fire('Text to Speech Notification', 'Text exceeded allowed length, maximum allowed text length is ' + text_length_limit + ' characters. Please decrease the overall text length.', 'warning'); 
        } else {
            map.set(voice, value);
            startSynthesizeMode(1, map, value);
        }

    } else {

        for (let i = 0; i < textarea.length; i++) {

            let value = textarea[i].value;
            let voice = textarea[i].getAttribute('data-voice');
            let distinct = generateID(3);
            
            if (value != '') {
                map.set(voice +'___'+ distinct, value);
                full_text +=value;
            } else {
                full_textarea--;
            }
        }

        if (full_text.length == 0) {
            Swal.fire('Missing Input Text', 'Enter your text that you want to synthezise before processing', 'warning');
        } else if (full_text.length > text_length_limit) { 
            Swal.fire('Text to Speech Notification', 'Text exceeded allowed length, maximum allowed total text length is ' + text_length_limit + ' characters. Please decrease the text length.', 'warning'); 
        } else {
            startSynthesizeMode(full_textarea, map, full_text);
        }    
    }
});

function startSynthesizeMode(length, map, all_text) {

    let text_object = Object.fromEntries(map);
    let data = $('#synthesize-text-form').serializeArray();

    data.push({name: 'length', value: length});
    data.push({name: 'input_text_total', value: all_text});
    data.push({name: 'input_text', value: JSON.stringify(text_object)});

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        type: "POST",
        url: $('#synthesize-text-form').attr('action'),
        data: data,
        beforeSend: function() {
            $('#synthesize-text').html('');
            $('#synthesize-text').prop('disabled', true);
            $('#processing').show().clone().appendTo('#synthesize-text');  
            $('#processing').hide();    
            $('#waveform-box').slideUp('slow')      
        },
        complete: function() {
            $('#synthesize-text').prop('disabled', false);
            $('#processing', '#synthesize-text').empty().remove();
            $('#processing').hide();
            $('#synthesize-text').html('Synthesize');            
         },
        success: function(data) {     
            animateValue("balance-number", data['old'], data['current'], 2000);
            $("html, body").animate({scrollTop: $("#results-header").offset().top}, 200);
			$("#resultTable").DataTable().ajax.reload();
        },
        error: function(data) {
            if (data.responseJSON['error']) {
                Swal.fire('Text to Speech Notification', data.responseJSON['error'], 'warning');
            }

            $('#synthesize-text').prop('disabled', false);
            $('#processing').remove();
            $('#synthesize-text').html('Synthesize');            
        }
    }).done(function(data) {})
}


/*************************************************
 *  Process Live Synthesize Listen Mode
 *************************************************/
 $('#listen-text').on('click', function(e) {

    "use strict";
    
    e.preventDefault()

    let map = new Map();
    let textarea = document.getElementsByTagName("textarea");
    let full_textarea = textarea.length;
    let full_text = '';

    if (textarea.length == 1) {
        let value = document.getElementById('ZZZOOOVVVZ').value;
        let voice = document.getElementById('ZZZOOOVVVZ').getAttribute('data-voice');

        if (value.length == 0) {
            Swal.fire('Missing Input Text', 'Enter your text that you want to synthezise before processing', 'warning');
        } else if (value.length > text_length_limit) { 
            Swal.fire('Text to Speech Notification', 'Text exceeded allowed length, maximum allowed text length is ' + text_length_limit + ' characters. Please decrease the text length.', 'warning'); 
        } else {
            map.set(voice, value);
            startListenMode(1, map, value);
        }

    } else {

        for (let i = 0; i < textarea.length; i++) {

            let value = textarea[i].value;
            let voice = textarea[i].getAttribute('data-voice');
            let distinct = generateID(3);
            
            if (value != '') {
                map.set(voice +'___'+ distinct, value);
                full_text +=value;
            } else {
                full_textarea--;
            }
        }

        if (full_text.length == 0) {
            Swal.fire('Missing Input Text', 'Enter your text that you want to synthezise before processing', 'warning');
        } else if (full_text.length > text_length_limit) { 
            Swal.fire('Text to Speech Notification', 'Text exceeded allowed length, maximum allowed total text length is ' + text_length_limit + ' characters. Please decrease the overall text length.', 'warning'); 
        } else {
            startListenMode(full_textarea, map, full_text);
        }    
    }
});

function startListenMode(length, map, all_text) {

    let text_object = Object.fromEntries(map);
    let data = $('#synthesize-text-form').serializeArray();

    data.push({name: 'length', value: length});
    data.push({name: 'input_text_total', value: all_text});
    data.push({name: 'input_text', value: JSON.stringify(text_object)});

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        type: "POST",
        url: $('#synthesize-text-form').attr('listen'),
        data: data,
        beforeSend: function() {
            $('#listen-text').html('');
            $('#listen-text').prop('disabled', true);
            $('#processing').show().clone().appendTo('#listen-text'); 
            $('#processing').hide();           
            $('#waveform-box').slideUp('slow')   
        },
        complete: function() {
            $('#listen-text').prop('disabled', false);
            $('#processing', '#listen-text').empty().remove();
            $('#processing').hide();
            $('#listen-text').html('Listen');                
        },
        success: function(data) {
            animateValue("balance-number", data['old'], data['current'], 2000);
            $('#waveform-box').slideDown('slow');
        },
        error: function(data) {
            if (data.responseJSON['error']) {
                Swal.fire('Text to Speech Notification', data.responseJSON['error'], 'warning');
            }

            $('#listen-text').prop('disabled', false);
            $('#listen-text').html('Listen');     
            $('#waveform-box').slideUp('slow');            
        }
    }).done(function(data) {

        let download = document.getElementById('downloadBtn');

        if (download) {
            document.getElementById('downloadBtn').href = data['url'];
        }

        let main_audio = document.getElementById('media-element');
        main_audio.setAttribute('src', data['url']);
        main_audio.setAttribute('type', data['audio_type']);
        wavesurfer.load(main_audio);

        wavesurfer.on('ready',     
            wavesurfer.play.bind(wavesurfer),
            playBtn.innerHTML = '<i class="fa fa-pause"></i>',
            playBtn.classList.add('isPlaying'),
        );

    })

};


let playBtn = document.getElementById('playBtn');
let stopBtn = document.getElementById('stopBtn');
let forwardBtn = document.getElementById('forwardBtn');
let backwardBtn = document.getElementById('backwardBtn');
let wave = document.getElementById('waveform');

let wavesurfer = WaveSurfer.create({
    container: wave,
    waveColor: '#ff9d00',
    progressColor: '#1e1e2d',
    selectionColor: '#d0e9c6',
    backgroundColor: '#ffffff',
    barWidth: 2,
    barHeight: 4,
    barMinHeight: 1,
    height: 50,
    responsive: true,				
    barRadius: 1,
    fillParent: true,
    plugins: [
        WaveSurfer.timeline.create({
            container: "#wave-timeline",
            timeInterval: 1,
        }),
        WaveSurfer.cursor.create({
            showTime: true,
            opacity: 1,
            customShowTimeStyle: {
                'background-color': '#000',
                color: '#fff',
                padding: '2px',
                'font-size': '10px'
            }
        }),
    ]
});



playBtn.onclick = function(e) {
    e.preventDefault();

    wavesurfer.playPause();
    if (playBtn.innerHTML.includes('fa-play')) {
        playBtn.innerHTML = '<i class="fa fa-pause"></i>';
        playBtn.classList.add('isPlaying');
    } else {
        playBtn.innerHTML = '<i class="fa fa-play"></i>';
        playBtn.classList.remove('isPlaying');
    }
}

stopBtn.onclick = function(e) {
    e.preventDefault();

    wavesurfer.stop();	
    playBtn.innerHTML = '<i class="fa fa-play"></i>';
    playBtn.classList.remove('isPlaying');
}

forwardBtn.onclick = function(e) {
    e.preventDefault();
    
    wavesurfer.skipForward(3);	
}

backwardBtn.onclick = function(e) {
    e.preventDefault();

    wavesurfer.skipBackward(3);	
}

wavesurfer.on('finish', function() {
    playBtn.innerHTML = '<i class="fa fa-play"></i>';
    playBtn.classList.remove('isPlaying');
    wavesurfer.stop();	
});


/*===========================================================================
*
*  Create New Row 
*
*============================================================================*/
let total_rows = 1;
$('#addTextRow').on('click', function (e) {

    'use strict';

    e.preventDefault();

    if (total_rows != voices_limit) {
        let rowCode = insertNewRow("");

        tippy.delegate('.textarea-buttons', { 
            target: '[data-tippy-content]',
            animation: 'scale-extreme',
            theme: 'material',
        });

        insertNewLine();        
        
        $('#' + rowCode + ' textarea').focus();

    } else {
        Swal.fire('Voice Lines Limit Reached', 'You have reached maximum number of lines for text', 'info');
    }
    

}); 


function insertNewRow(input_text="") {
    let newID = generateID(10);
    let newRow = '<div class="textarea-row" id="' + newID + '">' +
                    '<div class="textarea-voice">' +
                        '<div class="ml-1 mt-1"><img src="' + textarea_img + '" alt="" data-tippy-content="' + textarea_voice_details + '"></div>' +
                    '</div>' +
                    '<div class="textarea-text">' +
                        '<textarea class="form-control textarea" id="' + newID + 'Z" data-voice="' + textarea_voice_id + '" onkeyup="countCharacters();" onmousedown="mouseDown(this);" name="textarea[]" rows="1" maxlength="5000">' + input_text + '</textarea>' +
                    '</div>' +
                    '<div class="textarea-actions">' +
                        '<div class="textarea-buttons">' +
                            '<button class="btn buttons synthesizeText" id="' + newID + 'L" onclick="listenRow(this); return false;" data-tippy-content="Listen Text" ><i class="fa-solid fa-message-music"></i></button>' +
                            '<button class="btn buttons addPause" id="' + newID + 'P" onclick="addPause(this); return false;" data-tippy-content="Add Pause After Text"><i class="fa-regular fa-hourglass-clock"></i></button>' +
                            '<button class="btn buttons deleteText" id="' + newID + 'DEL" onclick="deleteRow(this); return false;" data-tippy-content="Delete This Text Block"><i class="fa-solid fa-trash"></i></button>' +
                        '</div>' +
                    '</div>' +
                '</div>';
    
    $("#textarea-row-box").append(newRow);

    tippy.delegate('.textarea-voice', { 
        target: '[data-tippy-content]',
        animation: 'scale-extreme',
        theme: 'material',
    });

    
    if (total_rows < voices_limit) {
        total_rows++;
    }

    if (input_text == '') {
        countCharacters();
    }

    return newID;
}


function generateID(length) {
    let result           = '';
    let characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    let charactersLength = characters.length;

    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }

    return result;
}


function deleteRow(row) {
    let id = row.id;

    if(id != 'ZZZOOOVVVDEL') {
        id = id.slice(0, -3);
        $('#' + id).remove();
        total_rows--;
        countCharacters();

    } else {
        let main_img = document.getElementById('ZZZOOOVVVIMG');
        main_img.setAttribute('src', textarea_img);

        let main_voice = document.getElementById('ZZZOOOVVVZ');
        main_voice.setAttribute('data-voice', textarea_voice_id);

        let instance = tippy(document.getElementById('ZZZOOOVVVIMG'));
        instance.setProps({
            animation: 'scale-extreme',
            theme: 'material',
            content: textarea_voice_details,
        });

        main_voice.value = "";
        if (total_rows == 1) {
            $('#total-characters').text('0 characters, 1 line');
        }

        Swal.fire('Main Text Line', 'Main text line cannot be deleted, line voice will change to the main selected one', 'warning');
    }

}


function addPause(row) {

    let id = row.id;
    id = id.slice(0, -1);

    var cursorPosition = document.getElementById(id + 'Z').selectionStart;
    var content = $("#" + id + "Z").val();

    var text = '<div class="pt-4"><span id="swal2-wait-time" class="font-weight-bold text-primary">+1000ms</span></div>';

    Swal.fire({
        title: 'Add Pause',
        html: text,
        input: 'range',
        inputAttributes: {
            min: 100,
            max: 5000,
            step: 100
        },
        inputValue: 1000,
        showCancelButton: true,
        confirmButtonText: 'Add',
        reverseButtons: true,
        showLoaderOnConfirm: false,
        didOpen: () => {
            const inputRange = Swal.getInput()
            inputRange.nextElementSibling.style.display = 'none'
            inputRange.style.width = '100%'

            $('.swal2-range input[type=range]').on('input change', function() {
                $('#swal2-wait-time').html("+" + $(this).val() + "ms")
            });
        },

    }).then((result) => {
        if (result.isConfirmed) {
            var timeValue = result.value;

            let textWait = " <break time=\"" + timeValue + "ms\"/> ";
            $("#" + id + "Z").val(content.slice(0, cursorPosition).trimEnd() + textWait + content.slice(cursorPosition).trimStart());
        }
    })
}


function mouseDown(row) {
    selectedTextarea = row.id;
}


function insertNewLine() {
    let textarea = document.getElementsByTagName("textarea");

    for (let i = 0; i < textarea.length; i++) {
        textarea[i].setAttribute("style", "height:" + (textarea[i].scrollHeight) + "px;overflow-y:hidden;");
        textarea[i].addEventListener("input", onEnterButton, false);
    }
}


function onEnterButton() {
    this.style.height = "auto";
    this.style.height = (this.scrollHeight) + "px";
}


function countCharacters() {
    let all = document.querySelectorAll("textarea");
    let lines = all.length;
    let total = '';

    all.forEach(function (item, index) {
        var text = document.getElementsByClassName("textarea")[index].value;
        total += text.trim() + ' ';
    });

    var chars = total.trim().length;
    if (lines == 1) {
        $('#total-characters').text(chars + ' characters, ' + lines + ' line');
    } else {
        $('#total-characters').text(chars + ' characters, ' + lines + ' lines');
    }
}


/*===========================================================================
*
*  Listen Row 
*
*============================================================================*/
function listenRow(row) {

    let id = row.id;
    id = id.slice(0, -1);

    let text = document.getElementById(id + 'Z');
    let voice = text.getAttribute('data-voice');
    let format = document.querySelector('input[name="format"]:checked').value;

    if (text.value == '') {    
        Swal.fire('Text to Speech Notification', 'Please enter text to synthesize first', 'warning');    
    } else if (text.value.length > text_length_limit) { 
        Swal.fire('Text to Speech Notification', 'Text exceeded allowed length, maximum allowed text length is ' + text_length_limit + ' characters. Please decrease the text length.', 'warning'); 
    } else {

        let selected_text = "";
        if (window.getSelection) {
            selected_text = window.getSelection().toString();
        } else if (document.selection && document.selection.type != "Control") {
            selected_text = document.selection.createRange().selected_text;
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: 'text-to-speech/listen-row',
            data: { row_text:text.value, voice:voice, selected_text:selected_text, format:format, selected_text_length:selected_text.length},
            beforeSend: function() {
                $('#' + row.id).html('<i class="fa-solid fa-waveform-lines"></i>');
                $('#' + row.id).prop('disabled', true);         
                $('#waveform-box').slideUp('slow')   
            },
            complete: function() {
                $('#' + row.id).prop('disabled', false);
                $('#' + row.id).html('<i class="fa-solid fa-message-music"></i>');              
            },
            success: function(data) {
                animateValue("balance-number", data['old'], data['current'], 2000);
                $('#waveform-box').slideDown('slow')
            },
            error: function(data) {
                if (data.responseJSON['error']) {
                    Swal.fire('Text to Speech Notification', data.responseJSON['error'], 'warning');
                }

                $('#' + row.id).prop('disabled', false);
                $('#' + row.id).html('<i class="fa-solid fa-message-music"></i>');    
                $('#waveform-box').slideUp('slow')            
            }
        }).done(function(data) {

            let download = document.getElementById('downloadBtn');

            if (download) {
                document.getElementById('downloadBtn').href = data['url'];
            }
            
            wavesurfer.load(data['url']);

            wavesurfer.on('ready',     
                wavesurfer.play.bind(wavesurfer),
                playBtn.innerHTML = '<i class="fa fa-pause"></i>',
                playBtn.classList.add('isPlaying'),
            );
        })
    }
    
}


/*===========================================================================
*
*  Read File
*
*============================================================================*/
function readFile() {

    Swal.fire({
        title: 'Upload File',
        showCancelButton: true,
        confirmButtonText: 'Upload',
        reverseButtons: true,
        inputLabel: 'Only TXT files up to ' + text_length_limit + ' characters length are supported',
        input: 'file',
    }).then((file) => {
        if (file.value) {
            let file = $('.swal2-file')[0].files[0];
            let file_name = file['name'];
            let extension = file_name.split('.').pop();

            if (extension != 'txt') {
                Swal.fire('Incorrect File Format', 'Following file format - ' + extension + ' -  is not allowed. Select a txt file.', 'error');
            } else {
                let reader = new FileReader()
                reader.onload = event => processText(event.target.result) 
                reader.onerror = error => reject(error)
                reader.readAsText(file)
            }

        } else if (file.dismiss !== Swal.DismissReason.cancel) {
            Swal.fire('No File Selected', 'Make sure to select a text file before uploading', 'error');
        }
    })

}

function processText(text) {

    if (text.length > text_length_limit) {
        Swal.fire('Maximum Text Length Reached', 'Maximum text length of the uploaded text file can be up to ' + text_length_limit + ' characters. Selected file contains ' + text.length + ' characters', 'warning');
    } else {
        let text_chunks = chunkString(text, 5000);

        for (var i = 0; i < text_chunks.length; i++) {

            if (text_chunks.length == 1) {
                document.getElementById('ZZZOOOVVVZ').value = text_chunks[0];
            } else {
                if (i == 0) {
                    document.getElementById('ZZZOOOVVVZ').value = text_chunks[0];
                } else {
                    if (i < voices_limit) {
                        insertNewRow(text_chunks[i]);
                    } else {
                        Swal.fire('Maximum Text Length Reached', 'Maximum text length of the uploaded text file can be up to ' + text_length_limit + ' characters. Selected file contains ' + text.length + ' characters.', 'warning');
                        break;
                    }                
                }
            }
        }
    }
}

function chunkString(str, length) {
    return str.match(new RegExp('.{1,' + length + '}', 'g'));
}

function animateValue(id, start, end, duration) {
    if (start === end) return;
    var range = end - start;
    var current = start;
    var increment = end > start? 1 : -1;
    var stepTime = Math.abs(Math.floor(duration / range));
    var obj = document.getElementById(id);
    var timer = setInterval(function() {
        current += increment;
        obj.innerHTML = current;
        if (current == end) {
            clearInterval(timer);
        }
    }, stepTime);
}




  
 