/*===========================================================================
*
*  TTS Dashboard 
*
*============================================================================*/
let previous_language;
let previous_voice = '';
let previous_selection = 0;
let textarea_language;

$(document).ready(function(){

    "use strict";

    $('.avoid-clicks').on('click',false);

    let current = $(".ssml");
    $("#text-type input[type='radio']").on('change', function() {
        current.hide();
        current = $("." + $("#text-type input[type='radio']:checked").val() );
        current.show();
    });

    let language = document.getElementById("languages");
    previous_language = language.value;
    textarea_language = language.options[language.selectedIndex].text;

    let voice = document.getElementById("voices");
    previous_voice = 'current-' + voice.value;

})

function language_select(value){

    "use strict";

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
}
