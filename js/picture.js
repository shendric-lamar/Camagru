var like = null;
var remove = null;

like = document.getElementById("like-icon");
remove = document.getElementById("remove-photo");
like.addEventListener('click', like_photo);
remove.addEventListener('click', remove_photo);

function remove_photo(){
    var photo = window.location.href.slice(48);
    if (!confirm("Do you want to remove this picture?")) {
        return ;
    }
    var http = new XMLHttpRequest();
    var url = 'includes/remove.php';
    var params = 'photo=' + photo;
    http.open('POST', url, true);

    //Send the proper header information along with the request
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() {//Call a function when the state changes.
        if(http.readyState == 4 && http.status == 200) {
        }
    }
    http.send(params);
    window.location.reload(true);
}

function like_photo() {
    var photo = window.location.href.slice(48);
    var http = new XMLHttpRequest();
    var url = 'includes/like.php';
    var params = 'photo=' + photo;
    http.open('POST', url, true);

    //Send the proper header information along with the request
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() {//Call a function when the state changes.
        if(http.readyState == 4 && http.status == 200) {
        }
    }
    http.send(params);
    window.location.reload(true);
}
