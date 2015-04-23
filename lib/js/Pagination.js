/*
*	params: json object
*	params["TotalPages"] : total number of pages
*	params["Callback"] : function to execute on page change
*/
$.fn.Pagination = function(params) {
	var TotalPages = parseInt(params["TotalPages"]);
	var CurrentPage = parseInt(params["CurrentPage"]);
	var Callback = params["Callback"];

	if (isNaN(CurrentPage)) CurrentPage = 1;
	if (isNaN(TotalPages) || TotalPages < 1) TotalPages = 1;

	var container = $('<span class="Pagination"></span>');

	var ui = '<input type="hidden" class="CurrentPage" value=' + CurrentPage + ' />';
	if (TotalPages > 10) {
		ui += '<a class="btn btn-sm btn-info PrevPage" href="#">&laquo;</a>';
		ui += 'Page <input type="number" class="InputPage text-center" value="' + CurrentPage + '" ';
		ui += 'min=1 max=' + TotalPages + ' />';
		ui += '<button class="PageSwitch btn btn-sm btn-default"><span class="glyphicon glyphicon-share"></span></button>';
		ui += '<span>(' + TotalPages + ' pages)</span>';
		ui += '<a class="btn btn-sm btn-info NextPage" href="#">&raquo;</a>'
	} else {
		ui += '<ul class="pagination">';
		ui += '<li><a class="PrevPage" href="#">&laquo;</a></li>';

		for (var i = 1; i <= TotalPages; i++) {
			ui += '<li><a class="GoToPage" href="' + i + '">' + i + '</a></li>';
		}

		ui += '<li><a class="NextPage" href="#">&raquo;</a></li>';
		ui += '</ul>';

	}

	container.append($(ui));
	$(this).html(container);
	Callback();

	if (CurrentPage <= 1) {
		container.find(".PrevPage").toggleClass("disable", true);
	} else {
		container.find(".PrevPage").toggleClass("disable", false);
	}

	if (CurrentPage >= TotalPages) {
		container.find(".NextPage").toggleClass("disable", true);
	} else {
		container.find(".NextPage").toggleClass("disable", false);
	}

	container.find(".InputPage").val(CurrentPage);

	container.find(".PageSwitch").on("click", function(e) {
		e.preventDefault();

		var temp = parseInt(container.find('.InputPage').val());
		if (temp < 1 || isNaN(temp) || temp > TotalPages) {
			var validPage = container.find('.CurrentPage').val();
			container.find('.InputPage').val(validPage);
		} else {
			container.find(".CurrentPage").val(temp);
			Callback();
		}
	});

	container.find(".PrevPage").on("click", function(e) {
		e.preventDefault();

		var temp = parseInt(container.find(".CurrentPage").val()) - 1;
		if (temp < 1 || isNaN(temp) || temp > TotalPages) return;
		
		container.find(".CurrentPage").val(temp);
		container.find(".CurrentPage").change();
		container.find(".InputPage").val(temp);
		Callback();
	});

	container.find(".NextPage").on("click", function(e) {
		e.preventDefault();

		var temp = parseInt(container.find(".CurrentPage").val()) + 1;
		if (temp < 1 || isNaN(temp) || temp > TotalPages) return;

		container.find(".CurrentPage").val(temp);
		container.find(".CurrentPage").change();
		container.find(".InputPage").val(temp);
		Callback();
	});

	container.find(".GoToPage").on("click", function(e) {
		e.preventDefault();

		var temp = parseInt($(this).attr("href"));
		if (temp < 1 || isNaN(temp) || temp > TotalPages) return;

		container.find('.pagination .active').toggleClass('active', false);
		$(this).closest('li').toggleClass('active', true);

		container.find(".CurrentPage").val(temp);
		Callback();
	});

	container.find(".CurrentPage").on("change", function() {
		container.find('.pagination .active').toggleClass('active', false);
		container.find('.GoToPage[href="' + $(this).val() + '"]').closest('li').toggleClass('active', true);

		if (parseInt($(this).val()) <= 1) {
			container.find(".PrevPage").toggleClass("disable", true);
		} else {
			container.find(".PrevPage").toggleClass("disable", false);
		}

		if (parseInt($(this).val()) >= TotalPages) {
			container.find(".NextPage").toggleClass("disable", true);
		} else {
			container.find(".NextPage").toggleClass("disable", false);
		}

	});

	container.find('.GoToPage[href="' + $(".CurrentPage").val() + '"]').closest('li').toggleClass('active', true);
}