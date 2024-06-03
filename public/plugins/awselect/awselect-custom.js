/**

jQuery Awselect
Developed by: Prev Wong 
Documentation: https://prevwong.github.io/awesome-select/
Github: https://github.com/prevwong/awesome-select/

**/

var awselect_count = 0; // used for generating sequential ID for <select> that does not have ID
var mobile_width = 800;

(function($) {
    $(document).mouseup(function(e) {
        var awselect = $(".awselect");
        if (!awselect.is(e.target) && awselect.has(e.target).length === 0) 
        {
            deanimate();
        }
    });
    $.fn.awselect = function(options) {
        var element = $(this);
        var opts = $.extend({}, $.fn.awselect.defaults, options);
        element.each(function() {
            awselect_count += 1;
            build($(this), opts);
            
        });
        this.on("aw:animate", function() {
            animate(getawselectElement($(this)));
            
        });
        this.on("change", function() {
            setValue(this);
        });
        this.on("aw:deanimate", function() {
           deanimate(getawselectElement($(this)))
        });

        return {
            blue: function() {
                element.css("color", "blue");
            }
        };
    };
    $.fn.awselect.defaults = {
        background: "#e5e5e5",
        active_background: "#fff",
        placeholder_color: "#000",
        placeholder_active_color: "#000",
        option_color: "#000",
        vertical_padding: "15px",
        horizontal_padding: "40px",
        immersive: false,
    };
    function getawselectElement(select) {
        return $('.awselect[data-select="' + select.attr("id") + '"]');
    }
    function build(element, opts) {
        var placeholder = element.attr("data-placeholder");
        var id = element.attr("id");
        var options = element.children("option");
        var selected = false;
        var classes = "awselect";
        var options_html = "";
        var background = opts["background"];
        var active_background = opts["active_background"];
        var placeholder_color = opts["placeholder_color"];
        var placeholder_active_color = opts["placeholder_active_color"];
        var option_color = opts["option_color"];
        var vertical_padding = opts["vertical_padding"];
        var horizontal_padding = opts["horizontal_padding"];
        var immersive = opts["immersive"];
        if ( immersive !== true ) {
            var immersive = false;
        }

        options.each(function() {
           var current_img = $(this).attr("data-img");
           var current_icon = $(this).attr("data-icon");
           var usage_status = $(this).attr("data-usage");
           var data_class = $(this).attr("data-class");
           var data_lang = $(this).attr("data-lang");
           var data_id = $(this).attr("data-id");
           var data_type = $(this).attr("data-type");
           var data_gender = $(this).attr("data-gender");
           

            if (typeof $(this).attr("selected") !== typeof undefined && $(this).attr("selected") !== false) {
                if(current_img !== undefined) {
                    if(data_gender !== undefined && data_type == 'neural') {
                        selected = '<span id=current-' + data_id + '><img class="awselect-img voice-avatar-img" src="' + current_img  +'">' + $(this).text() + '<i class="text-muted no-italics fs-10">(' + data_gender + ')</i><i class="voice-neural-sign"> (Neural)</i></span>';
                    } else if(data_gender !== undefined && data_type == 'standard') {
                        selected = '<span id=current-' + data_id + '><img class="awselect-img voice-avatar-img" src="' + current_img  +'">' + $(this).text() + '<i class="text-muted no-italics fs-10">(' + data_gender + ')</i></span>';
                    } else {

                        selected = '<span id=current-' + data_id + '><img class="awselect-img" src="' + current_img  +'">' + $(this).text() + '</span>';
                        
                    }
                    
                } else if(data_gender !== undefined && data_type == 'neural') {
                    selected = '<span id=current-' + data_id + '>' + $(this).text() + '<i class="text-muted no-italics fs-10">(' + data_gender + ')</i><i class="voice-neural-sign"> (Neural)</i></span>';
                } else if(data_gender !== undefined && data_type == 'standard') {
                    selected = '<span id=current-' + data_id + '>' + $(this).text() + '<i class="text-muted no-italics fs-10">(' + data_gender + ')</i></span>';
                } else {
                    selected = '<span id=current-' + data_id + '>' + $(this).text() + '</span>';
                }
            }

            if(current_img === undefined) {
                if (data_type == 'neural') {
                    options_html += '<li><a class="' + usage_status + ' ' + data_class + ' ' + data_lang + '" style="padding: 2px '+ horizontal_padding +'">' + $(this).text() + '<span class="text-muted fs-10">(' + data_gender + ')</span><span class="voice-neural-sign"> (Neural)</span></a></li>'; 
                } else if(data_type == 'standard') {
                    options_html += '<li><a class="' + usage_status + ' ' + data_class + ' ' + data_lang + '" style="padding: 2px '+ horizontal_padding +'">' + $(this).text() + '<span class="text-muted fs-10">(' + data_gender + ')</span></a></li>'; 
                } else {    
                    if(current_icon !== undefined) {                
                        options_html += '<li><a class="' + usage_status + ' ' + data_class + ' ' + data_lang + '" style="padding: 2px '+ horizontal_padding +'"><span class="awselect-icon-style mr-3">' + current_icon + '</span>' + $(this).text() + '</a></li>'; 
                    } else {
                        options_html += '<li><a class="' + usage_status + ' ' + data_class + ' ' + data_lang + '" style="padding: 2px '+ horizontal_padding +'">' + $(this).text() + '</a></li>'; 
                    }
                }
            } else {

                if (data_type == 'neural') {
                    options_html += '<li><a class="' + usage_status + ' ' + data_class + ' ' + data_lang + '" style="padding: 2px '+ horizontal_padding +'"><img class="awselect-img voice-avatar-img" src="' + current_img +'">' + $(this).text() + '<span class="text-muted fs-10">(' + data_gender + ')</span><span class="voice-neural-sign"> (Neural)</span></a></li>'; 
                } else if(data_type == 'standard') {
                    options_html += '<li><a class="' + usage_status + ' ' + data_class + ' ' + data_lang + '" style="padding: 2px '+ horizontal_padding +'"><img class="awselect-img voice-avatar-img" src="' + current_img +'">' + $(this).text() + '<span class="text-muted fs-10">(' + data_gender + ')</span></a></li>'; 
                } else {
                    if(current_icon !== undefined) {
                        options_html += '<li><a class="' + usage_status + ' ' + data_class + ' ' + data_lang + '" style="padding: 2px '+ horizontal_padding +'"><span class="awselect-icon-style mr-3">' + current_icon + '</span><img class="awselect-img" src="' + current_img +'">' + $(this).text() + '</a></li>'; 
                    } else {
                        options_html += '<li><a class="' + usage_status + ' ' + data_class + ' ' + data_lang + '" style="padding: 2px '+ horizontal_padding +'"><img class="awselect-img" src="' + current_img +'">' + $(this).text() + '</a></li>'; 
                    }
                }
            }
           
        });
        if (selected !== false) {
            classes += " hasValue";
        }
        if (typeof id !== typeof undefined && id !== false) {
            id_html = id;
        } else {
            id_html = "awselect_" + awselect_count;
            $(element).attr("id", id_html);
        }
        var data_id = $(this).attr('data-id');
        var awselect_html = '<div data-immersive="'+ immersive +'" id="awselect_' + id_html + '" data-select="' + id_html + '" class = "' + classes + '"><div style="background:' + active_background + '" class = "bg"></div>';
        awselect_html += '<div style="padding:' + vertical_padding + " " + horizontal_padding + '" class = "front_face">';
        awselect_html += '<div style="background:' + background + '" class = "bg"></div>';
        awselect_html += '<div data-inactive-color="' + placeholder_active_color + '" style="color:' + placeholder_color + '" class = "content">';
        if (selected !== false) {
            awselect_html += '<span class="current_value">' + selected + "</span>";
        }
        awselect_html += '<span class = "placeholder">' + placeholder + "</span>";
        awselect_html += '<i class = "icon">' + icon(placeholder_color) + "</i>";
        awselect_html += "</div>";
        awselect_html += "</div>";
        awselect_html += '<div style="padding:' + vertical_padding + ' 0;" class = "back_face"><ul style="color:' + option_color + '">';
        awselect_html += options_html;
        awselect_html += "</ul></div>";
        awselect_html += "</div>";
        $(awselect_html).insertAfter(element);
       element.hide();

    }

    function animate(element) {
        if (element.hasClass("animating") == false) {
            element.addClass("animating");
            if ($(".awselect.animate").length > 0) {
                deanimate($(".awselect").not(element));
                var timeout = 600;
            } else {
                var timeout = 100;
            }
            var immersive = element.attr('data-immersive')
            
            if ($(window).width() < mobile_width || immersive == "true" ) {
                immersive_animate(element);
                timeout += 200
            }
            setTimeout(function() {
                var back_face = element.find(".back_face");
                back_face.show();
                var bg = element.find("> .bg");
                bg.css({
                    height: element.outerHeight() + back_face.outerHeight()
                });
                back_face.css({
                    "margin-top": $(element).outerHeight()
                });
                
                if ( $(window).width() < mobile_width || immersive === "true" ) {
                    element.css({
                        "top": parseInt(element.css('top')) - back_face.height()
                    })
                }
                element.addClass("placeholder_animate");
                setTimeout(function() {
                    switchPlaceholderColor(element);
                    setTimeout(function(){
                        if (back_face.outerHeight() == 400) {
                            back_face.addClass("overflow");
                        }
                    }, 200);
                  
                    
                    element.addClass("placeholder_animate2");
                    element.addClass("animate");
                    element.addClass("animate2");
                    element.removeClass("animating");
                }, 100);
            }, timeout);
        }
    }

    function immersive_animate(element) {
        $(".awselect_bg").remove()
        $('body, html').addClass('immersive_awselect')
        $('body').prepend('<div class = "awselect_bg"></div>')
        setTimeout(function(){
             $('.awselect_bg').addClass('animate')
        }, 100)
       
       
        var current_width = element.outerWidth()
        var current_height = element.outerHeight()
        var current_left = element.offset().left
        var current_top = element.offset().top - $(window).scrollTop() 
        element.attr('data-o-width', current_width)
        element.attr('data-o-left', current_left)
        element.attr('data-o-top', current_top)
        element.addClass('transition_paused').css({
            "width" : current_width,
            "z-index": "9999"
       })
        setTimeout(function(){
            $('<div class = "awselect_placebo" style="position:relative; width:'+ current_width +'px; height:'+ current_height +'px; float:left;ß"></div>').insertAfter(element)
            element.css({
                "position": "fixed",
                "top" : current_top,
                "left": current_left
            })
            element.removeClass('transition_paused')
            setTimeout(function(){
                if ( $(window).width() < mobile_width ) {
                     element.css('width', $(window).outerWidth() - 40 )
                } else {
                     element.css('width', $(window).outerWidth() / 2)
                }
               
                element.css({
                    "top" : $(window).outerHeight() / 2 + element.outerHeight() / 2,
                    "left" : "50%",
                    "transform": "translateX(-50%) translateY(-50%)"
                })
                setTimeout(function(){
                    animate(element)
                 }, 100)
            }, 100)
        }, 50)
    }

    function deanimate(awselects) {
        if (awselects == null) {
            var awselect = $(".awselect");
        } else {
            var awselect = awselects;
        }
        $(awselect).each(function() {
            var element = $(this);
            
            if (element.hasClass("animate")) {
                setTimeout(function() {
               
                }, 300);
                element.removeClass("animate2");
                element.find(".back_face").hide();
                element.find('.back_face').removeClass('overflow')
                element.removeClass("animate");
                switchPlaceholderColor(element);

                element.children(".bg").css({
                    height: 0
                });
                element.removeClass("placeholder_animate2");
                setTimeout(function() {
                    immersive_deanimate(element)
                    element.removeClass("placeholder_animate");
                }, 100);
            }
        });
    }
    function immersive_deanimate(element){
       
        if ( element.siblings('.awselect_placebo').length > 0 ) {
           

            setTimeout(function(){
                var original_width = element.attr('data-o-width')
                var original_left = element.attr('data-o-left')
                var original_top = element.attr('data-o-top')

                element.css({
                    "width" : original_width,
                    "left" : original_left + "px",
                    "transform": "translateX(0) translateY(0)",
                    "top" : original_top + "px"
                })
                 $('.awselect_bg').removeClass('animate')
                setTimeout(function(){
                    $('.awselect_placebo').remove()
                    $('body, html').removeClass('immersive_awselect')
                    setTimeout(function(){ 
                        $('.awselect_bg').removeClass('animate').remove()
                    }, 200);
                    element.attr('style', '')
                }, 300)
            }, 100)
            
        }
        

    }

    function switchPlaceholderColor(element) {
        var placeholder_inactive_color = element.find(".front_face .content").attr("data-inactive-color");
        var placeholder_normal_color = element.find(".front_face .content").css("color");
        element.find(".front_face .content").attr("data-inactive-color", placeholder_normal_color);
        element.find(".front_face .content").css("color", placeholder_inactive_color);
        element.find(".front_face .icon svg").css("fill", placeholder_inactive_color);
    }
    function setValue(select) {
        var val = $(select).val();
        var awselect = getawselectElement($(select));
        var option_value = $(select).children('option[value="' + val + '"]').eq(0);
        var img = $(option_value).attr('data-img');
        var icon = $(option_value).attr('data-icon');
        var data_lang = $(option_value).attr('data-lang');
        var data_id = $(option_value).attr('data-id');
        var data_type = $(option_value).attr("data-type");
        var data_gender = $(option_value).attr("data-gender");
        var callback = $(select).attr("data-callback");

        if(img === undefined) {
            if (data_type == 'neural') {
                $(awselect).find(".current_value").remove();
                $(awselect).find(".front_face .content").prepend('<span id="current-' + data_id + '" class = "current_value ' + data_lang + '">' + option_value.text() + '<i class="text-muted fs-10 no-italics">(' + data_gender + ')</i><i class="voice-neural-sign"> (Neural)</i></span>');
            } else if(data_type == 'standard') {
                $(awselect).find(".current_value").remove();
                $(awselect).find(".front_face .content").prepend('<span id="current-' + data_id + '" class = "current_value ' + data_lang + '">' + option_value.text() + '<i class="text-muted fs-10 no-italics">(' + data_gender + ')</i></span>');
            } else {
               
                    $(awselect).find(".current_value").remove();
                    $(awselect).find(".front_face .content").prepend('<span id="current-' + data_id + '" class = "current_value ' + data_lang + '">' + option_value.text() + "</span>");
                
            }
        } else {

            if (data_type == 'neural') {
                $(awselect).find(".current_value").remove();
                $(awselect).find(".front_face .content").prepend('<span id="current-' + data_id + '" class = "current_value ' + data_lang + '"><img class="awselect-img voice-avatar-img" src="' + img + '">' + option_value.text() + '<i class="text-muted fs-10 no-italics">(' + data_gender + ')</i><i class="voice-neural-sign"> (Neural)</i></span>');
            } else if(data_type == 'standard') {
                $(awselect).find(".current_value").remove();
                $(awselect).find(".front_face .content").prepend('<span id="current-' + data_id + '" class = "current_value ' + data_lang + '"><img class="awselect-img voice-avatar-img" src="' + img + '">' + option_value.text() + '<i class="text-muted fs-10 no-italics">(' + data_gender + ')</i></span>');
            } else {
                if(icon !== undefined) {
                    $(awselect).find(".current_value").remove();
                    $(awselect).find(".front_face .content").prepend('<span id="current-' + data_id + '" class = "current_value ' + data_lang + '"><span class="awselect-icon-style mr-3">' + icon +'</span><img class="awselect-img" src="' + img + '">' + option_value.text() + "</span>");
                } else {
                    $(awselect).find(".current_value").remove();
                    $(awselect).find(".front_face .content").prepend('<span id="current-' + data_id + '" class = "current_value ' + data_lang + '"><img class="awselect-img" src="' + img + '">' + option_value.text() + "</span>");
                }
            }
        }
           
        
        $(awselect).addClass("hasValue");
        if (typeof callback !== typeof undefined && callback !== false) {
            window[callback](option_value.val());
        }
        setTimeout(function() {
            deanimate();
        }, 100);
    }
    function icon(color) {
        return '<svg style="fill:' + color + '" version="1.1" id="Chevron_thin_down" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve"><path d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0c0.27,0.268,0.271,0.701,0,0.969l-7.908,7.83c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25L17.418,6.109z"/></svg>';
    }
    function change(elem) {
        elem.css("color", "green");
    }
})(jQuery);


$(document).ready(function() {
    $("body").on("click", ".awselect .front_face", function() {
        var dropdown = $(this).parent('.awselect');
       
        if ( dropdown.hasClass("animate") == false) {
            $("select#" + dropdown.attr("id").replace("awselect_", "")).trigger("aw:animate");
        } else {
             $("select#" + dropdown.attr("id").replace("awselect_", "")).trigger("aw:deanimate");
        }
        
    });



    $("body").on("click", ".awselect ul li a", function() {
        var dropdown = $(this).parents(".awselect");
        var value_index = $(this).parent("li").index();
        var id = dropdown.attr("data-select");
        var select = $("select#" + id);
        var option_value = $(select).children("option").eq(value_index);
        var callback = $(select).attr("data-callback");  
        $(select).val(option_value.val());
        $(select).trigger("change");
    });
});

