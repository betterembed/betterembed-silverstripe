var betterembed_show = document.querySelectorAll('.js-betterembed-show-message,.js-betterembed-load-remote,.js-betterembed-close');
document.querySelectorAll('button.js-betterembed-show-message').forEach(function (button) {
    button.innerHTML = 'show original';
});
var showhidebtn = document.getElementsByClassName('.js-betterembed-show-message')[0];
for (var i = 0; i < betterembed_show.length; i++) {
    betterembed_show[i].addEventListener('click', function (e) {

        var container = this.closest('.js-betterembed');
        var showhidebtn = container.querySelector('button.js-betterembed-show-message');

        if (e.currentTarget.classList.contains('js-betterembed-show-message')) {
            container.classList.toggle('is-betterembed-msg-visible');
            container.classList.remove('is-betterembed-remote-visible');
            showhidebtn.innerHTML = 'show original';
        }

        if (e.currentTarget.classList.contains('js-betterembed-close')) {
            container.classList.remove('is-betterembed-msg-visible');
        }

        if (e.currentTarget.classList.contains('js-betterembed-load-remote')) {
            var embed_elem = container.lastElementChild;
            //embed_elem.innerHTML = load_remote;
            container.classList.toggle('is-betterembed-remote-visible');

            //ajax stuff
            var request = new XMLHttpRequest();

            var ajax_url = e.currentTarget.getAttribute('data-beitemlink');

            request.open('GET', ajax_url, true);

            request.onload = function () {
                if (request.status >= 200 && request.status < 400) {
                    var resp = request.responseText;

                    embed_elem.innerHTML = resp;

                    //search for script tags and make executing this
                    var scripts = Array.prototype.slice.call(embed_elem.getElementsByTagName("script"));
                    for (var i = 0; i < scripts.length; i++) {
                        if (scripts[i].src != "") {
                            var tag = document.createElement("script");
                            tag.src = scripts[i].src;
                            document.getElementsByTagName("head")[0].appendChild(tag);
                        } else {
                            eval(scripts[i].innerHTML);
                        }
                    }
                }
            };
            request.send();
            //end ajax stuff

            showhidebtn.innerHTML = 'hide original';

        }

        e.preventDefault();

    }, false);
}
