/*Populating content in the drop downs for School and departments*/

function dropdowns(ddl1, ddl2){
    		var ns = ['-- select department --','Biological Sciences','Computer Science','Chemistry','Geography','Mathematics & Statistics','Physics'];
    		var humanities = ['-- select department --','Development Studies','Economics','History','Political & Administrative Studies','Population Studies','Psychology','Philosophy & Applied Ethics','Mass Communication','Literature & Language','Gender Studies','Social Development Studies'];
    		var education = ['-- select department --','Adult Education & Extension Studies', 'Advisory Units for Colleges of Education','Education Administration & Policy Studies','Educational Psychology, Socialogy & Special Education','Library Information Studies','Language & Social Sciences','Mathematics & Science Education', 'Primary Education','Religious Studies'];
            var engineering = ['-- select department --','Agricutural Engineering','Civil & Enviromental Engineering','Electrical & Electronic Engineering', 'Mechanical Engineering','Geomatic Engineering'];
            var law = ['-- select department --','Public Law','Private Law'];
    		var agric = ['-- select department --','Agriculture Economics', 'Animal Science', 'Food Science & Nutrition', 'Plant Science', 'Soil Science'];
            var mines = ['-- select department --','Geology','Mines Engineering','Metarllugy & Material Processing','Specialized Units'];
            var veterinary= ['-- select department --','Biomedical Studies','Clinical Studies','Disease Control','Para-Clinical Studies','Central Services & Supply'];
            var medicine = ['-- select department --','Anatomy','Biomedical Scinces','Physiological Sciences','Nursing Sciences','Medical Education Development','Obstetrics & Gynaecology','Paediatrics & Child Health','Pathology & Microbiology','Pharmacy','Physiotherapy','Psychiatry','Public Health','Surgery','Internal Medicine'];

    		switch(ddl1.value) {
    			case '8':
    				ddl2.options.length = 0;
    				var v = 50;
    				for (i = 0;i < ns.length;i++ ) {
    					createOption(ddl2,ns[i],v);
    					v++;
    				}
    				break;
    			case '4':
    				ddl2.options.length = 0;
    				var m = 19;
    				for (var i = 0;i < humanities.length;i++) {
    					createOption(ddl2, humanities[i],m);
    					m++
    				}
    				break;
    			case '2':
    			    var k = 5;
    				ddl2.options.length = 0;
    				for (var i = 0;i < education.length;i++) {
    					createOption(ddl2, education[i],k);
    					k++;
    				}
    				break;
    			case '1':
    				ddl2.options.length =0;
    				var j = 0;
                    for (var i = 0;i < agric.length;i++) {
                        createOption(ddl2, agric[i],j);
                        j++;
                    }

    				break;
                case '5':
                    ddl2.options.length = 0;
                    var n = 30;
                    for (var i = 0;i < law.length;i++){
                        createOption(ddl2,law[i],n);
                        n++;
                    }
                    break;
                case '3':
                    var l = 14;
                    ddl2.options.length = 0;
                    for (var i = 0;i < engineering.length;i++){
                        createOption(ddl2,engineering[i],l);
                        l++
                    }
                    break;
                case '6':
                    ddl2.options.length = 0;
                    var p = 36;
                    for (var i= 0;i< medicine.length;i++) {
                        createOption(ddl2,medicine[i],p);
                        p++;
                    }
                    break;
                case '7':
                    ddl2.options.length = 0;
                    var q = 32;
                    for (var i = 0;i < mines.length;i++) {
                        createOption(ddl2,mines[i],q);
                        q++;
                    }
                    break;
                case '9':
                    var x = 56;
                    ddl2.options.length = 0;
                    for (var i= 0;i < veterinary.length;i++){
                        createOption(ddl2,veterinary[i],x);
                        x++;

                    }
                    break;        
    				default:
    					ddl2.options.length = 0;
    				break;

    		}
    	}

        function createOption(ddl, text, value){
            var opt = document.createElement('option');
            opt.value = value;
            opt.text = text;
            ddl.options.add(opt);
        }

        var positions = ["Head of Department","Dean of School" ,"Academic Staff","Support Staff"];

        var sel = document.getElementById('Positions');
        var fragment = document.createDocumentFragment();
        positions.forEach(function(position, index) {
            var opt = document.createElement('option');
            opt.innerHTML = position;
            opt.value = position;
            fragment.appendChild(opt);
        });
        sel.appendChild(fragment);

    /*Populating content in the drop downs for School and departments*/
    /* End */

    /*Custom Calendar JavaScript */

     $(window).load(function () {

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var started;
        var categoryClass;

        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {
                $('#fc_create').click();

                started = start;
                ended = end

                $(".antosubmit").on("click", function () {
                    var title = $("#title").val();
                    if (end) {
                        ended = end
                    }
                    categoryClass = $("#event_type").val();

                    if (title) {
                        calendar.fullCalendar('renderEvent', {
                                    title: title,
                                    start: started,
                                    end: end,
                                    allDay: allDay
                                },
                                true // make the event "stick"
                        );
                    }
                    $('#title').val('');
                    calendar.fullCalendar('unselect');

                    $('.antoclose').click();

                    return false;
                });
            },
            eventClick: function (calEvent, jsEvent, view) {
                //alert(calEvent.title, jsEvent, view);

                $('#fc_edit').click();
                $('#title2').val(calEvent.title);
                categoryClass = $("#event_type").val();

                $(".antosubmit2").on("click", function () {
                    calEvent.title = $("#title2").val();

                    calendar.fullCalendar('updateEvent', calEvent);
                    $('.antoclose2').click();
                });
                calendar.fullCalendar('unselect');
            },
            editable: true,
            events: []
        });
    });

    /*Custom Calendar JavaScript */
    /*....End....*/

    /*Custom Table JavaScript*/

    !function ($) {
        $(document).on("click", "ul.nav li.parent > a > span.icon", function () {
            $(this).find('em:first').toggleClass("glyphicon-minus");
        });
        $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
    }(window.jQuery);

    $(window).on('resize', function () {
        if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
    })
    $(window).on('resize', function () {
        if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    })

    /*Custom Table JavaScript*/
    /*....End....*/





