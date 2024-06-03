/*===========================================================================
*
*  AUDIO PLAYER - GREEN AUDIO PLAYER PLUGIN 
*
*============================================================================*/

$(document).ready(function() {

    "use strict";
 
     GreenAudioPlayer.init({
         selector: '.player', // inits Green Audio Player on each audio container that has class "player"
         stopOthersOnPlay: true,
     });

     GreenAudioPlayer.init({
        selector: '.user-result-player', // inits Green Audio Player on each audio container that has class "player"
        stopOthersOnPlay: false,
        showDownloadButton: true,
        showTooltips: true
    });

    GreenAudioPlayer.init({
        selector: '.green-player', // inits Green Audio Player on each audio container that has class "player"
        stopOthersOnPlay: false,
        showDownloadButton: true,
        showTooltips: true
    });
 
 });


/*===========================================================================
*
*  AUDIO PLAYER - SINGLE BUTTON PLAYER
*
*============================================================================*/

let current = '';
let current_file = '';
let audio = new Audio();
let audio_file = new Audio();

function resultPlay(element){

    var src = $(element).attr('src');
    var type = $(element).attr('type');
    var id = $(element).attr('id');

    var isPlaying = false;
    
    audio.src = src;
    audio.type= type;    

    if (current == id) {
        audio.pause();
        isPlaying = false;
        document.getElementById(id).innerHTML = '<i class="fa fa-play table-action-buttons view-action-button" title="Play Audio File"></i>';
        document.getElementById(id).classList.remove('result-pause');
        current = '';

    } else {    
        if(isPlaying) {
            audio.pause();
            isPlaying = false;
            document.getElementById(id).innerHTML = '<i class="fa fa-play table-action-buttons view-action-button" title="Play Audio File"></i>';
            document.getElementById(id).classList.remove('result-pause');
            current = '';
        } else {
            audio.play();
            isPlaying = true;
            if (current) {
                document.getElementById(current).innerHTML = '<i class="fa fa-play table-action-buttons view-action-button" title="Play Audio File"></i>';
                document.getElementById(current).classList.remove('result-pause');
            }
            document.getElementById(id).innerHTML = '<i class="fa fa-pause table-action-buttons view-action-button" title="Play Audio File"></i>';
            document.getElementById(id).classList.add('result-pause');
            current = id;
        }
    }

    audio.addEventListener('ended', (event) => {
        document.getElementById(id).innerHTML = '<i class="fa fa-play table-action-buttons view-action-button" title="Play Audio File"></i>';
        document.getElementById(id).classList.remove('result-pause');
        isPlaying = false;
        current = '';
    });      
        
}

function previewPlay(element){

    let src = $(element).attr('src');
    let type = $(element).attr('type');
    let id = $(element).attr('id');

    let isPlaying = false;
    
    audio.src = src;
    audio.type= type;    

    if (current == id) {
        audio.pause();
        isPlaying = false;
        document.getElementById(id).innerHTML = '<i class="fa-solid fa-volume-high"></i>';
        current = '';

    } else {    
        if(isPlaying) {
            audio.pause();
            isPlaying = false;
            document.getElementById(id).innerHTML = '<i class="fa-solid fa-volume-high"></i>';
            current = '';
        } else {
            audio.play();
            isPlaying = true;
            if (current) {
                document.getElementById(current).innerHTML = '<i class="fa-solid fa-volume-high"></i>';
            }
            document.getElementById(id).innerHTML = '<i class="fa-solid fa-volume-slash"></i>';
            current = id;
        }
    }

    audio.addEventListener('ended', (event) => {
        document.getElementById(id).innerHTML = '<i class="fa-solid fa-volume-high"></i>';
        isPlaying = false;
        current = '';
    });      
        
}

function previewAudio(element){

    let src = $(element).attr('src');
    let id = $(element).attr('id');

    let isPlaying = false;
    
    if (src == '') {
        Swal.fire('Audio File Not Selected', 'Select your audio file first before listening it', 'warning');
    } else {

        audio_file.src = src; 


        if (current_file == id) {
            audio_file.pause();
            isPlaying = false;
            document.getElementById(id).innerHTML = '<i class="fa-solid fa-music-note"></i>';
            current_file = '';

        } else {    
            if(isPlaying) {
                audio_file.pause();
                isPlaying = false;
                document.getElementById(id).innerHTML = '<i class="fa-solid fa-music-note"></i>';
                current_file = '';
            } else {
                audio_file.play();
                isPlaying = true;
                if (current_file) {
                    document.getElementById(current_file).innerHTML = '<i class="fa-solid fa-music-note"></i>';
                }
                document.getElementById(id).innerHTML = '<i class="fa-solid fa-music-note-slash"></i>';
                current_file = id;
            }
        }

        audio_file.addEventListener('ended', (event) => {
            document.getElementById(id).innerHTML = '<i class="fa-solid fa-music-note"></i>';
            isPlaying = false;
            current_file = '';
        });   
    }   
        
}


 


 