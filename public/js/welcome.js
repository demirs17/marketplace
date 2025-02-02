function ajax(page){
    $.ajax({
        type: "GET",
        url: "paginate",
        data: {page: page},
        dataType: "json",
        success: function (response) {
            $("#ads").html("");
            $("#page-numbers").html("");
            console.log(response);
            var adCount = response.count;
            var data = response.data;
            var perPage = response.perPage;
            var currentPage = response.currentPage;
            for(var i = 0;i<data.length;i++){
                document.getElementById("ads").innerHTML += 
                '<a href="ad?id='+ data[i].id +'" class="ad">'+data[i].title+" | "+data[i].price+' &#8378;</a>';
            }
            var pageCount = Math.ceil(adCount/perPage);
    
            var adsDiv = document.getElementById("page-numbers");
            if(currentPage-1 > 1){
                adsDiv.innerHTML += '<div class="page-number">' + 1 + '</div>';
                adsDiv.innerHTML += " ... ";

            }
            adsDiv.innerHTML += (currentPage-1) > 0 ? '<div class="page-number">'+ (currentPage-1) +'</div>' : '';
            adsDiv.innerHTML += '<div class="page-number current-page">'+ currentPage +'</div>';
            if(currentPage < pageCount){
                adsDiv.innerHTML += '<div class="page-number">'+ (currentPage+1) +'</div>';
            }
            if(currentPage + 1 < pageCount){
                adsDiv.innerHTML += " ... ";
                adsDiv.innerHTML += '<div class="page-number">'+ (pageCount) +'</div>';
            }
    
    
    
            $(".page-number").click(function (e) { 
                e.preventDefault();
                ajax($(this).text());
            });
        }
    });
}

$(document).ready(function () {
    ajax(1);
});
// const xhttp = new XMLHttpRequest();
// xhttp.onload = function() {
//     document.getElementById("ads").innerHTML = this.responseText;
// }
// xhttp.open("GET", "paginate?page=1", true);
// xhttp.send();