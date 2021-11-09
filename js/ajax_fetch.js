jQuery(document).ready(function($){
    var showroomCount = 2;
    $("#show_more").click(function() {
        showroomCount += 2;
        $("#showrooms").load("load-showrooms.php", {
            showroomNewCount: showroomCount
        });
    });
});
// function showShowRoom(str) {
//     if (str == "") {
//         document.getElementById("contentHint").innerHTML = "";
//         return;
//     } else {
//         var xmlhttp = new XMLHttpRequest();
//         xmlhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             document.getElementById("contentHint").innerHTML = this.responseText;
//         }
//         };
//         xmlhttp.open("GET","load-showrooms.php?q="+str,true);
//         xmlhttp.send();
//     }
// }
// document.getElementById("show_rooms").onchange = function() {
//     showShowRoom(this.value)
// }