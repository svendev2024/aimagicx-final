/**
 * jQuery Simple Text Counter
 *
 * @homepage https://github.com/hugosbg/jquery-simple-txt-counter#readme
 * @author Hugo Gomes <hugo.msn@msn.com>
 * @version 0.1.6
 * @license MIT
 */
;(function ($) {
    $.fn.simpleTxtCounter = function (options) {
        const settings = $.extend({
            after: undefined,
            maxLength: undefined,
            countText: undefined,
            countElem: '<div/>',
            lineBreak: true
        }, options);

        const counter = (input, length, max, uniqueId) => {
            const { after, countText, countElem } = settings;
            let count = countText ? `${countText} ${length}` : length;
            if (max) {
                count += ` / ${max}`;
            }

            const wrap = $(countElem).attr('id', uniqueId).text(count);
            const parent = input.closest(after);

            if (parent.length) {
                let elem = parent.next('[id^=simple-txt-counter]');
                if (elem.length) {
                    elem.text(count);
                } else {
                    parent.after(wrap);
                }

            } else {
                let elem = input.next('[id^=simple-txt-counter]');
                if (elem.length) {
                    elem.text(count);
                } else {
                    input.after(wrap);
                }
            }
        }

        return this.each(function (key) {
            const input = $(this);
            const max = parseInt(input.attr('maxlength') || settings.maxLength);
            const uniqueId = `simple-txt-counter-${key}`;

            counter(input, this.value.length, max, uniqueId);

            input.on('input', function () {
                counter(input, this.value.length, max, uniqueId);

                if (this.value && max) {
                    if (settings.lineBreak === false) {
                        this.value = this.value.replace(/(\r\n|\n|\r)/gm, " ").slice(0, max);
                    } else {
                        this.value = this.value.slice(0, max);
                    }
                }
            }).on('keypress', function (event) {
                const keyCode = event.which || event.keyCode;
                if (settings.lineBreak === false && keyCode === 13) {
                    event.preventDefault();
                    return false;
                }
            })
        });
    };
}(jQuery));
