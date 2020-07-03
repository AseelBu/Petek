$(document).ready(function () {
  let userId=1;
        $.ajax({
            type: "GET",
            url: "api/getUserLists.php",
            data: {
                userId: userId
            },
           // dataType: "json",
            success: function (data) {
                console.log("hallo");
                // $.each(data,function(i,list){
                console.log(data);

            },
            error: function (xhr, ajaxOptions, error) {
                console.log(error);
            }
        });
        

});