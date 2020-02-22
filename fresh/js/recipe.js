
document.addEventListener("DOMContentLoaded", function() {

    // For Likes
    document.getElementById('like0').addEventListener('click', function() {
        document.getElementById('l-val0').innerHTML++;
    });
    document.getElementById('like1').addEventListener('click', function() {
        document.getElementById('l-val1').innerHTML++;
    });
    document.getElementById('like2').addEventListener('click', function() {
        document.getElementById('l-val2').innerHTML++;
    });

    // For Dislikes
    document.getElementById('dislike0').addEventListener('click', function() {
        document.getElementById('d-val0').innerHTML++;
    });
    document.getElementById('dislike1').addEventListener('click', function() {
        document.getElementById('d-val1').innerHTML++;
    });
    document.getElementById('dislike2').addEventListener('click', function() {
        document.getElementById('d-val2').innerHTML++;
    });

});

