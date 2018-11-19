$('#calendar').fullCalendar({
	header: {
				left: 'prev,next today',
				center: 'title',
				right: 'listDay,listWeek,month'
			},
	views: {
				listDay: { buttonText: 'Daftar Kegiatan per Hari' },
				listWeek: { buttonText: 'Daftar Kegiatan per Minggu' }
			},
	locale: 'id',
    eventSources: [
        'index.php?r=ajax/getkalender'
    ]
});