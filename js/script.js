
////function showDistrict(str) {
//
//    var xmlhttp = new XMLHttpRequest();
//    xmlhttp.onreadystatechange = function () {
//        if (this.readyState == 4 && this.status == 200) {
//            document.getElementById("district").innerHTML = this.responseText;
//        }
//    };
//    xmlhttp.open("GET", "district.php?id=" + str, true);
//    xmlhttp.send();
//
//}


//AJAX for Address
   $(document).on('change','#divisionId', function(){
      var divisionId = $(this).val();
          $.ajax({
              type:'POST',
              url:'district.php',
              datatype:"html",
              data:{id:divisionId},
              success:function(result){
                  $('#district').html(result);
                 
              }
          }); 
  });
  
    $(document).on('change','#districtId', function(){
      var districtId = $(this).val();
          $.ajax({
              type:'POST',
              url:'thana.php',
              datatype:"html",
              data:{id:districtId},
              success:function(result){
                  $('#thanaId').html(result);
                 
              }
          }); 
  });

//function showThana(val) {
//    $.ajax({
//        type: "POST",
//        url: "thana.php",
//        data: 'id=' + val,
//
//        success: function (data) {
//            $("#thana").html(data);
//        }
//    });
//}
//
//function showThana(str) {
//    if (str == "") {
//        document.getElementById("thana").innerHTML = "";
//        return;
//    } else {
//        var xmlhttp = new XMLHttpRequest();
//        xmlhttp.onreadystatechange = function () {
//            if (this.readyState == 4 && this.status == 200) {
//                document.getElementById("thana").innerHTML = this.responseText;
//            }
//        };
//        xmlhttp.open("GET", "thana.php?id=" + str, true);
//        xmlhttp.send();
//    }
//}

//For div disappear

// $('#hideDiv').fadeOut(3000);

$(function () {
    $("#hideDiv").fadeIn(function () {
        setTimeout(function () {
            $("#hideDiv").fadeOut("fast");
        }, 3000);
    });
});



//For Delete confirmation

//function confirm(anchor) {
//    var conf = confirm('Are you sure want to delete this record?');
//    if (conf)
//        window.location = anchor.attr("href");
//}

//For preview image
function img_pathUrl(input) {
    $('#img_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
}