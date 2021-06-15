var activeScenario = $('#scenario a.scenario-btns.active').attr('href');
var activeCategory = $('#ucd a.ucd-btn.active').attr('href');
var activeYear = $('#years a.years-btn.active').attr('href') == '#first' ? 1 : 2;
var activeScenarioName = activeScenario.replace('#','');
var activeCategoryName = activeCategory.replace('#','');
var activeDashboard = '';
$('.scenario-btns , .ucd-btn , .years-btn, .nav-ucd-btn, .nav-years-btn').on('click',function(){
  $(this).addClass('active'); $(this).siblings().removeClass('active');
});


$('a.scenario-btns[data-toggle="tab"]').on('click',function(){
    $('.tab-pane.parent').fadeOut().removeClass('active');
    $('#ucd .ucd-btn:first').trigger('click');
    $($(this).attr('href')+'.tab-pane').fadeIn().addClass('active');
    activeScenario = $('#scenario a.scenario-btns.active').attr('href');
});

$('a.ucd-btn[data-toggle="tab"]').on('click',function(){
    $(activeScenario).find('.tab-pane.child-tab').fadeOut().removeClass('active');
    $(activeScenario).find($(this).attr('href')+'.tab-pane').fadeIn().addClass('active');
    activeCategory = $('#ucd a.ucd-btn.active').attr('href');
	activeCategoryName = activeCategory.replace('#','');
});


$('.share_of_biologics_patient').on('keyup',function(){
	var sum = 0;
	var value = parseFloat($(this).val());
	if(value > 100) {
		alert('The value of Share of biologics patients	cannot be more than 100%');
		return false;
	}
	$(activeScenario +' '+activeCategory).find('.share_of_biologics_patient').each(function(){
	    if(this.value != '')
	    sum += parseFloat(this.value);
	});
	if(sum > 100) {
		alert('Sum of the percentage be more than 100%');
		return false;
	}
	treated_with_biologics_patients = localStorage.getItem(activeCategoryName+'_treated_with_biologics_patients_year_'+activeYear)
	var competitor = $(this).data('competitor');
	ucp = Math.floor((value * treated_with_biologics_patients)/100);
	$(activeScenario +' '+activeCategory).find('input[name='+activeCategoryName+'_share_of_biologics_patient_value_competitor_'+competitor+']').val(ucp).trigger('change');
});

$('.biologis_existing_patients_rate').on('keyup change blur',function(){
	var value = parseFloat($(this).val());
	var competitor = $(this).data('competitor');
	var newpatient = 100 - value;
	$(activeScenario +' '+activeCategory).find('.biologis_new_patients_rate[data-competitor='+competitor+']').val(newpatient).trigger('change');
	var share_of_bio_patient = $('input[name='+activeCategoryName+'_share_of_biologics_patient_value_competitor_'+competitor).val();
	existingpatients = Math.floor((value * share_of_bio_patient)/100);
	$(activeScenario +' '+activeCategory).find('.biologis_existing_patients_value.competitor_'+competitor).val(existingpatients).trigger('change');;
	$(activeScenario +' '+activeCategory).find('.biologis_new_patients_value.competitor_'+competitor).val(share_of_bio_patient-existingpatients).trigger('change');;
});

$('.bionaive_new_patients_rate').on('keyup change blur',function(){
	var value = parseFloat($(this).val());
	var competitor = $(this).data('competitor');
	var newpatient = 100 - value;
	var biologis_new_patients = $(activeScenario +' '+activeCategory).find('.biologis_new_patients_value.competitor_'+competitor).val();
	newpatients = Math.floor((value * biologis_new_patients)/100);
	$(activeScenario +' '+activeCategory).find('.bionaive_new_patients_value.competitor_'+competitor).val(newpatients).trigger('change');;
	$(activeScenario +' '+activeCategory).find('.bioexperienced_new_patients_value.competitor_'+competitor).val(Math.floor(biologis_new_patients-newpatients)).trigger('change');
	$(activeScenario +' '+activeCategory).find('.bioexperienced_new_patients_rate[data-competitor="'+competitor+'"]').val(newpatient).trigger('change');
});

$('.bionaive_existing_patients_rate').on('keyup change blur',function(){
	var value = parseFloat($(this).val());
	var competitor = $(this).data('competitor');
	var existingpatient = 100 - value;
	var biologis_existing_patients = $(activeScenario +' '+activeCategory).find('.biologis_existing_patients_value.competitor_'+competitor).val();
	existingpatients = Math.floor((value * biologis_existing_patients)/100);
	$(activeScenario +' '+activeCategory).find('.bionaive_existing_patients_value.competitor_'+competitor).val(existingpatients).trigger('change');;
	$(activeScenario +' '+activeCategory).find('.bioexperienced_existing_patients_value.competitor_'+competitor).val(Math.floor(biologis_existing_patients-existingpatients)).trigger('change');
	$(activeScenario +' '+activeCategory).find('.bioexperienced_existing_patients_rate[data-competitor="'+competitor+'"]').val(existingpatient).trigger('change');
});

$('.biosim').on('keyup', function(){
	 var col = $(this).val();
	 var competitor = $(this).data('competitor');
	 var bioshare = $(this).data('bio');
	 var share_of_biologics_patient_value = $(activeScenario +' '+activeCategory).find('input[name='+activeCategoryName+'_share_of_biologics_patient_value_competitor_'+competitor+']').val()
	 var biosharevalue = Math.round((col * share_of_biologics_patient_value)/100);
	 $(activeScenario +' '+activeCategory).find('.biosimilars_value_'+bioshare+'.competitor_'+competitor).val(biosharevalue);
})

$('.access_scheme').on('change', function(){
  var col = $(this).data('col');
  var cost_per_viral = $('.cost_per_vial[data-col='+col+']').val();
  if(this.value != '')
  $('.calulated_cost_per_vial[data-col='+col+'], .calculated_access_scheme[data-col='+col+'], .calculated_fincost_per_vial[data-col='+col+']').attr('disabled',true);
  else 
  $('.calulated_cost_per_vial[data-col='+col+'], .calculated_access_scheme[data-col='+col+'], .calculated_fincost_per_vial[data-col='+col+']').attr('disabled',false);
  var fincost = Math.floor( (cost_per_viral * (100 - parseFloat(this.value)))/100)
  $('.fincost_per_vial[data-col='+col+']').val(fincost).trigger('change');;
});

$('.calculated_access_scheme').on('change', function(){
  var col = $(this).data('col');

  if(this.value != '')
  $('.access_scheme[data-col='+col+'], .fincost_per_vial[data-col='+col+']').attr('disabled',true);
  else 
  $('.access_scheme[data-col='+col+'], .fincost_per_vial[data-col='+col+']').attr('disabled',false);

  var access_scheme = $('.calculated_access_scheme[data-col='+col+']').val();
  var calulated_cost_per_viral = $('.calulated_cost_per_vial[data-col='+col+']').val();
  var calulatedfincost = Math.round( (1 / (parseFloat(access_scheme) + parseFloat(calulated_cost_per_viral)))*100)
  $('.access_scheme[data-col='+col+']').val(calulatedfincost);
  var cost_per_viral = $('.cost_per_vial[data-col='+col+']').val();
  var fincost = Math.floor( (cost_per_viral * (100 - parseFloat(this.value)))/100)
  $('.fincost_per_vial[data-col='+col+']').val(fincost).trigger('change');;
  $('.calculated_fincost_per_vial[data-col='+col+']').val(calulatedfincost).trigger('change');
}); 
var categoryName;
var competitor;
var updated = false;
var elem;
var rendered = [];
var elem2;
var costData = [1,2,6,11,12];
function updateDashboard(){
	$('#population .close').trigger('click');
	$('#marketshare .close').trigger('click');
	$('.modal-backdrop').remove();
	$("#nav-ucd a.nav-ucd-btn:not(:last-child)").each(function(i){
		activeDashboard = $(this).attr('href');
		var graphData = [];
		var patientgraphData = [];
		$("#scenario a.scenario-btns").each(function(i){
			var scenario = $(this).attr('href');
			active = scenario.replace('#','')+'-scenario';
			categoryName = activeDashboard.replace('#nav','');
			scenarioName = scenario.replace('#','');
			competitor = 1;
			
			$(scenario +' #'+categoryName).find('.share_of_biologics_patient_value').each(function(i){
				competitor = i + 1;
				var patients = localStorage.getItem(scenarioName+'_'+categoryName+'_share_of_biologics_patient_value_competitor_'+competitor);  
				if(patients > 100000) patients = (patients/100000).toFixed(2)+'l';
				if(patients > 1000) patients = (patients/1000).toFixed(2)+'k';
				$(activeDashboard).find('.'+active + ' .number_of_patients .circle[data-competitor="'+competitor+'"] p').html(patients);
				// var total_patients = patients;
				var total_bio_naive_patients = localStorage.getItem( scenarioName+'_'+categoryName+'_biologis_existing_patients_value_competitor_'+competitor) // b4
				var total_bio_experienced_patients = localStorage.getItem( scenarioName+'_'+categoryName+'_biologis_new_patients_value_competitor_'+competitor) // b5
				var perc_with_dose_esc = parseInt(localStorage.getItem( scenarioName+'_'+categoryName+'_perc_of_patients_with_escalation_year_'+activeYear+'_competitor_'+competitor))
				var bio_naive_patients_with_dose_escalation = Math.floor(perc_with_dose_esc*total_bio_naive_patients)/100 //b7
				var bio_experienced_patients_with_dose_escalation = Math.floor(perc_with_dose_esc * total_bio_experienced_patients)/100 //b8 
				
				var bio_naive_patients_without_dose_escalation = parseFloat(total_bio_naive_patients) - parseFloat(bio_naive_patients_with_dose_escalation) // b10
				var bio_experienced_patients_without_dose_escalation = parseFloat(total_bio_experienced_patients - bio_experienced_patients_with_dose_escalation) //b11
				var vials_4_patients_with_dose_escalation = parseFloat(localStorage.getItem( scenarioName+'_'+categoryName+'_average_num_of_vials_induction_competitor_'+competitor)) + parseFloat(localStorage.getItem( scenarioName+'_'+categoryName+'_avg_num_of_vials_maintenance_during_year_'+activeYear+'_competitor_'+competitor)) //b12
				var vials_4_patients_without_dose_escalation = parseFloat(localStorage.getItem( scenarioName+'_'+categoryName+'_average_num_of_vials_induction_competitor_'+competitor)) + parseFloat( localStorage.getItem( scenarioName+'_'+categoryName+'_average_num_of_vials_maintanance_competitor_'+competitor)) //b13
				
				var cost_per_vial_for_bio_naive_patients  = parseFloat(localStorage.getItem( scenarioName+'_'+categoryName+'_fincost_per_vial_data_'+costData[i])) //b15
				// console.log(competitor);
				// console.log(scenarioName+'_'+categoryName+'_fincost_per_viral_data_'+costData.indexOf(competitor-1));
				var cost_per_vial_for_bio_experienced_patients  = parseFloat(localStorage.getItem( activeScenarioName+'_'+categoryName+'_cost_per_vial_data_'+costData[i])) //b16
				var acquisition_cost = Math.floor( (  (bio_naive_patients_with_dose_escalation*vials_4_patients_with_dose_escalation)
														+
														(bio_naive_patients_without_dose_escalation*vials_4_patients_without_dose_escalation)
													) * cost_per_vial_for_bio_naive_patients
														+
												 (((bio_experienced_patients_with_dose_escalation*vials_4_patients_with_dose_escalation
														+
													 bio_experienced_patients_without_dose_escalation*vials_4_patients_without_dose_escalation))
												 	*cost_per_vial_for_bio_experienced_patients))
				// console.log(acquisition_cost);
				var bio_naive_acquisition_cost = Math.round((bio_naive_patients_with_dose_escalation*cost_per_vial_for_bio_naive_patients*vials_4_patients_with_dose_escalation)+(bio_naive_patients_without_dose_escalation*cost_per_vial_for_bio_naive_patients*vials_4_patients_without_dose_escalation))
				var bio_experienced_acquisition_cost = Math.round((bio_experienced_patients_with_dose_escalation*cost_per_vial_for_bio_experienced_patients*vials_4_patients_with_dose_escalation)+(bio_experienced_patients_without_dose_escalation*cost_per_vial_for_bio_experienced_patients*vials_4_patients_without_dose_escalation))
				var acquisition_cost_per_patient = Math.round(acquisition_cost / parseFloat(patients));
				var bio_naive_acquisition_cost_per_patient = Math.round(bio_naive_acquisition_cost/parseFloat(total_bio_naive_patients));
				var bio_experienced_acquisition_cost_per_patient = Math.round(bio_experienced_acquisition_cost/parseFloat(total_bio_experienced_patients));
				// console.log(vials_4_patients_with_dose_escalation)
				// console.log(bio_naive_patients_with_dose_escalation)
				// console.log(bio_naive_patients_without_dose_escalation)
				// console.log(vials_4_patients_without_dose_escalation)
				// console.log(cost_per_vial_for_bio_naive_patients)
				// console.log(bio_experienced_patients_with_dose_escalation)
				// console.log(vials_4_patients_with_dose_escalation)
				// console.log(bio_experienced_patients_without_dose_escalation)
				// console.log(vials_4_patients_without_dose_escalation)
				// console.log(cost_per_vial_for_bio_experienced_patients)
				// }
				
				// if(competitor == 1 & updated == false) { 
				// 	$(activeDashboard).find('h3:nth-child(2)').html('$ ' + acquisition_cost);
				// 	updated == true; 
				// }
				$(activeDashboard).find('.'+active + ' .acquisition_cost_per_biologic .rectangle[data-competitor="'+competitor+'"] p').html(acquisition_cost);				
				$(activeDashboard).find('.'+active + ' .acquisition_cost_per_patients .quad[data-competitor="'+competitor+'"] p.cost_value').html(acquisition_cost_per_patient);
				acquisition_cost = 0;
				vials_4_patients_with_dose_escalation = 0;
				bio_naive_patients_without_dose_escalation = 0;
				vials_4_patients_without_dose_escalation = 0;
				cost_per_vial_for_bio_naive_patients = 0;
				bio_experienced_patients_with_dose_escalation = 0;
				vials_4_patients_with_dose_escalation = 0;
				bio_experienced_patients_without_dose_escalation = 0;
				vials_4_patients_without_dose_escalation = 0;
				cost_per_vial_for_bio_experienced_patients = 0;
				
			});

			;
		});

		$("#scenario a.scenario-btns").each(function(i){
			var total_cost = 0;
			var scenario = $(this).attr('href');
				active = scenario.replace('#','')+'-scenario';	
				$(activeDashboard).find('.'+active + ' .acquisition_cost_per_biologic .rectangle p').each(function(i) {
					total_cost = total_cost + parseInt($(this).text());
					graphData[i] = parseInt($(this).text());
					$(this).parent().css('display','none');
				});
				$(activeDashboard).find('.'+active + ' .acquisition_cost_per_patients .quad p.cost_value').each(function(j) {
					// total_cost = total_cost + parseInt($(this).text());
					patientgraphData[j] = parseInt($(this).text());
					$(this).parent().css('display','none');
				});
				$(activeDashboard).find('.'+active + ' h3:nth-child(2)').html(total_cost);

				var data = [12000, 19000, 3000, 5000, 2000];
				updated = false;
				elem = activeDashboard+'_'+active+'_graphview';
				elem = elem.replace('#','');
				elem = elem.replace('-','_');
				
				elem2 = activeDashboard+'_'+active+'_patientsgraphview';

				elem2 = elem2.replace('#','');
				

				elem2 = elem2.replace('-','_');
				
				if(rendered.indexOf(elem) == -1) {
					rendered.push(elem);
					barChart(elem, graphData);
				}

				if(rendered.indexOf(elem2) == -1) {
					rendered.push(elem2);
					barChart(elem2, patientgraphData);
				}

			console.log(rendered);
		});
		var budgetImpact =  parseFloat($(activeDashboard).find('.new-scenario h3:nth-child(2)').html() - $(activeDashboard).find('.current-scenario h3:nth-child(2)').html());
		if(budgetImpact > 0)
		$(activeDashboard).find('.budget-impact').html(" + "+budgetImpact);
		else $(activeDashboard).find('.budget-impact').html(budgetImpact);


	});
		calcuatedUCD()
}

function calcuatedUCD(){
		var ucd_acq_cur_cost = [];
		var ucd_acq_cur_patients = []; 
		var ucd_acq_cur_cost_pp = [];
		var ucd_acq_new_cost = [];
		var ucd_acq_new_patients = [];
		var ucd_acq_new_cost_pp = [];

		var uc_acq_cur_cost = []; 
		var uc_acq_cur_patients = []; 
		var uc_acq_cur_cost_pp = [];
		var uc_acq_new_cost = [];
		var uc_acq_new_patients = [];
		var uc_acq_new_cost_pp = [];
		
		var cd_acq_cur_cost = [];
		var cd_acq_cur_patients = []; 
		var cd_acq_cur_cost_pp = [];
		var cd_acq_new_cost = [];
		var cd_acq_new_patients = [];
		var cd_acq_new_cost_pp = [];

		$('#navuc .current-scenario .number_of_patients .circle').each(function(i){
				uc_acq_cur_patients[i] = parseInt($(this).find('p').text());
		});
		$('#navcd .current-scenario .number_of_patients .circle').each(function(i){
				cd_acq_cur_patients[i] = parseInt($(this).find('p').text());
		});
		$('#navuc .new-scenario .number_of_patients .circle').each(function(i){
				uc_acq_new_patients[i] = parseInt($(this).find('p').text());
		});
		$('#navcd .new-scenario .number_of_patients .circle').each(function(i){
				cd_acq_new_patients[i] = parseInt($(this).find('p').text());
		});

		$('#navuc .current-scenario .acquisition_cost_per_biologic .rectangle').each(function(i){
				uc_acq_cur_cost[i] = parseInt($(this).find('p').text());
		});
		$('#navcd .current-scenario .acquisition_cost_per_biologic .rectangle').each(function(i){
				cd_acq_cur_cost[i] = parseInt($(this).find('p').text());
		});
		$('#navuc .new-scenario .acquisition_cost_per_biologic .rectangle').each(function(i){
				uc_acq_new_cost[i] = parseInt($(this).find('p').text());
		});
		$('#navcd .new-scenario .acquisition_cost_per_biologic .rectangle').each(function(i){
				cd_acq_new_cost[i] = parseInt($(this).find('p').text());
		});

		$('#navuc .current-scenario .acquisition_cost_per_patients .quad').each(function(i){
				uc_acq_cur_cost_pp[i] = parseInt($(this).find('p.cost_value').text());
		});
		$('#navcd .current-scenario .acquisition_cost_per_patients .quad').each(function(i){
				cd_acq_cur_cost_pp[i] = parseInt($(this).find('p.cost_value').text());
		});
		$('#navuc .new-scenario .acquisition_cost_per_patients .quad').each(function(i){
				uc_acq_new_cost_pp[i] = parseInt($(this).find('p.cost_value').text());
		});
		$('#navcd .new-scenario .acquisition_cost_per_patients .quad').each(function(i){
				cd_acq_new_cost_pp[i] = parseInt($(this).find('p.cost_value').text());
		});
		
		$(uc_acq_cur_cost).each(function(i,value){
				ucd_acq_cur_cost[i] = value + cd_acq_cur_cost[i];
				ucd_acq_new_cost[i] = uc_acq_new_cost[i] + cd_acq_new_cost[i];
				ucd_acq_new_cost_pp[i] = uc_acq_new_cost_pp[i] + cd_acq_new_cost_pp[i];
				ucd_acq_cur_cost_pp[i] = uc_acq_cur_cost_pp[i] + cd_acq_cur_cost_pp[i];
				ucd_acq_new_patients[i] = uc_acq_new_patients[i] + cd_acq_new_patients[i];
				ucd_acq_cur_patients[i] = uc_acq_cur_patients[i] + cd_acq_cur_patients[i];
		});

		$('#navucd .current-scenario .number_of_patients .circle').each(function(i){
				$(this).find('p').text(ucd_acq_cur_patients[i]);
		});
		$('#navucd .new-scenario .number_of_patients .circle').each(function(i){
				$(this).find('p').text(ucd_acq_new_patients[i]); 
		});
		$('#navucd .current-scenario .acquisition_cost_per_biologic .rectangle').each(function(i){
				$(this).find('p').text(ucd_acq_cur_cost[i]);
		});
		$('#navucd .new-scenario .acquisition_cost_per_biologic .rectangle').each(function(i){
				$(this).find('p').text(ucd_acq_new_cost[i]);
		});
		$('#navucd .current-scenario .acquisition_cost_per_patients .quad').each(function(i){
				$(this).find('p').text(ucd_acq_cur_cost_pp[i]);
		});
		$('#navucd .new-scenario .acquisition_cost_per_patients .quad').each(function(i){
				$(this).find('p').text(ucd_acq_new_cost_pp[i]); 
		});
		var activeDashboard = '#navucd';
		var total_cost = 0;
		var graphData = [];
		var patientgraphData = [];
		$("#scenario a.scenario-btns").each(function(i){
				$(activeDashboard).find('.'+active + ' .acquisition_cost_per_biologic .rectangle p').each(function(i) {
					total_cost = total_cost + parseInt($(this).text());
					graphData[i] = parseInt($(this).text());
					$(this).parent().css('display','none');
				});
				$(activeDashboard).find('.'+active + ' .acquisition_cost_per_patients .quad p.cost_value').each(function(j) {
					// total_cost = total_cost + parseInt($(this).text());
					patientgraphData[j] = parseInt($(this).text());
					$(this).parent().css('display','none');
				});
				$(activeDashboard).find('.'+active + ' h3:nth-child(2)').html(total_cost);
		});
		var budgetImpact =  parseFloat($(activeDashboard).find('.new-scenario h3:nth-child(2)').html() - $(activeDashboard).find('.current-scenario h3:nth-child(2)').html());
		if(budgetImpact > 0)
		$(activeDashboard).find('.budget-impact').html(" + "+budgetImpact);
		else $(activeDashboard).find('.budget-impact').html(budgetImpact);
}

function barChart(location, graphdata){
	console.log(graphdata);
	if($('#'+location).length > 0) {
		$('#'+location).show();
		var canvas = document.getElementById(location);
		eval(location);
		window[location] = canvas.getContext("2d");
 		 window[location+'chart'] = new Chart(window[location], {
		  type: 'bar',
		  data: {
		    labels: ["Vedolizumab","Adalimumab","Infliximab","Golimumab","Ustekinumab"],
		    datasets: [{		      
		      data: graphdata,
		      backgroundColor: [
		        '#9c75ad',
		        '#58b0ba',
		        '#d95180',
		        '#4a4b4d',
		        '#f35454'
		      ],
		      borderColor: [
		        '#9c75ad',
		        '#58b0ba',
		        '#d95180',
		        '#4a4b4d',
		        '#f35454'
		      ], 
		      borderWidth: 1
		    }]
		  },

		  options: {
			  	title: {
	                display: false,
	            },
	            legend: {
	                display: false,
	            },
			    responsive: true,
			    scales: {
			      xAxes: [{
			        gridLines: {
			        	 display:false
			        }
			      },
			      ],
			      yAxes: [{
			      	gridLines: {
			        	 display:false
			        },
			        ticks: {
	                    display: false,
	                    beginAtZero:true
	                }
			      }]
			    },
			    plugins: {
					labels: false
				}
			  }
			}); 
 		 
		} 
}
