import './bootstrap';
import 'bootstrap';


(function (){

    var request = new XMLHttpRequest();
    request.open('GET', '/getFeed');
    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200){
            document.getElementById('loading').remove();
            var data = request.responseText;

            let records = JSON.parse(request.responseText);

            records.forEach(parseData);

        }
    }
    request.send();

    function parseData(item, index, arr){
        var html = '<div class="card-text p-2 border-bottom mb-3">';
            html += '<h5>'+arr[index].title+'</h5>';
            html += '<p>'+arr[index].link+'</p>';
        html += '</div>';

        var cardBody = document.getElementById('card-body');

        cardBody.innerHTML += html;
    }

})();
