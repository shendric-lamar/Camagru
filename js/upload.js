(function() {
  // The width and height of the captured photo. We will set the
  // width to the value defined here, but the height will be
  // calculated based on the aspect ratio of the input stream.

  var width = 600;    // We will scale the photo width to this
  var height = 0;     // This will be computed based on the input stream

  // |streaming| indicates whether or not we're currently streaming
  // video from the camera. Obviously, we start at false.

  var streaming = false;

  // The various HTML elements we need to configure or control. These
  // will be set by the startup() function.

  var canvas = null;
  var file = null;
  var capture = null;
  var upload = null;
  var remove = null;
  var filter = null;
  var flag = 0;

  function startup() {
    canvas = document.getElementById('video');
    file = document.getElementById('file');
    remove = document.getElementById('remove');
    upload = document.getElementById('upload');
    refresh = document.getElementById('refresh-upload');
    filter = window.location.href.slice(48);

    upload.addEventListener('click', function(ev){
        myAjax();
        ev.preventDefault();
    }, false);

    refresh.addEventListener('click', function(ev){
      window.location.reload(true);
      ev.preventDefault();
    }, false);
  }

  // Fill the photo with an indication that none has been
  // captured.


  function myAjax() {
      if (!confirm("Do you want to upload this picture?")) {
          return ;
      }
      var http = new XMLHttpRequest();
      var url = 'includes/upload.php';
      var params = 'filter=' + filter;
      http.open('POST', url, true);

      //Send the proper header information along with the request
      http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

      http.onreadystatechange = function() {//Call a function when the state changes.
          if(http.readyState == 4 && http.status == 200) {
          }
      }
      http.send(params);
}
  // Set up our event listener to run the startup process
  // once loading is complete.
  window.addEventListener('load', startup, false);
})();
