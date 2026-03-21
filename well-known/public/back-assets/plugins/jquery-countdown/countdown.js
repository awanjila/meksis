$(function() {
	var austDay = new Date("january 1, 2029");
	$('#launch_date').countdown({
		until: austDay,
		layout: '<ul class="countdown"><li class="countdown1"><span class="number">{dn}<\/span><br/><span class="time">{dl}<\/span><\/li><li class="countdown2"><span class="number">{hn}<\/span><br/><span class="time">{hl}<\/span><\/li><li class="countdown3"><span class="number">{mn}<\/span><br/><span class="time">{ml}<\/span><\/li><li class="countdown4"><span class="number">{sn}<\/span><br/><span class="time">{sl}<\/span><\/li><\/ul>'
	});
	$('#year').text(austDay.getFullYear());
});