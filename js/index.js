var nav = {
	"POS" : "POS/default.html",
	"InventoryManagement" : "InventoryManagement/default.html",
	"Reports" : "Reports/default.html"
}

var page = "POS";
if (window.location.hash.length > 0) {
	page = window.location.hash.trim().replace("#", "");
}

loadPage(page);

$('ul.nav a').on('click', function() {
	var page = $(this).attr('href').replace("#", "");
	loadPage(page);
});

function loadPage(page) {
	$("#index-contents").html('<img class="imgLoading" src="library/images/loading.gif" alt="loading" />');
	$.ajax({
		url: nav[page],
		success: function(oHtml) {
			$("#index-contents").html(oHtml);
			window.location.hash = "#" + page;
			$("ul.nav").find("li.active").toggleClass("active", false);
			$('ul.nav a[href="#' + page + '"]').closest("li").toggleClass("active", true);
		}
	});
}
