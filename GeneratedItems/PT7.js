
(function(){

	/**
	 * Decimal adjustment of a number.
	 *
	 * @param	{String}	type	The type of adjustment.
	 * @param	{Number}	value	The number.
	 * @param	{Integer}	exp		The exponent (the 10 logarithm of the adjustment base).
	 * @returns	{Number}			The adjusted value.
	 */
	function decimalAdjust(type, value, exp) {
		// If the exp is undefined or zero...
		if (typeof exp === 'undefined' || +exp === 0) {
			return Math[type](value);
		}
		value = +value;
		exp = +exp;
		// If the value is not a number or the exp is not an integer...
		if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
			return NaN;
		}
		// Shift
		value = value.toString().split('e');
		value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
		// Shift back
		value = value.toString().split('e');
		return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
	}

	// Decimal round
	if (!Math.round10) {
		Math.round10 = function(value, exp) {
			return decimalAdjust('round', value, exp);
		};
	}
	// Decimal floor
	if (!Math.floor10) {
		Math.floor10 = function(value, exp) {
			return decimalAdjust('floor', value, exp);
		};
	}
	// Decimal ceil
	if (!Math.ceil10) {
		Math.ceil10 = function(value, exp) {
			return decimalAdjust('ceil', value, exp);
		};
	}

})();

// New seven-channel line up, March/24/2014, Adam
// only had 6 channels before
//	0		1		2		3		4		5		6
//	Casing, 	Tubing, 	Upstream 	Differential, 	Flow, 		Line    Temperature
// 	PsiG		PsiG		PsiG		PsiD		MMcf/D		PsiG	DegF

	var chart0; 
	var data0;
	var chart1; 
	var data1;
	var chart2; 
	var data2;
	var chart3; 
	var data3;
	var chart4;
	var data4;
	var chart5;
	var data5;
	var chart6;
	var data6;

      	google.load('visualization', '1', {packages:['gauge']});
      	google.setOnLoadCallback(initChart0);
      	google.load('visualization', '1', {packages:['gauge']});
      	google.setOnLoadCallback(initChart1);
      	google.load('visualization', '1', {packages:['gauge']});
      	google.setOnLoadCallback(initChart2);
      	google.load('visualization', '1', {packages:['gauge']});
      	google.setOnLoadCallback(initChart3);
      	google.load('visualization', '1', {packages:['gauge']});
      	google.setOnLoadCallback(initChart4);
		google.load('visualization', '1', {packages:['gauge']});
      	google.setOnLoadCallback(initChart5);
		google.load('visualization', '1', {packages:['gauge']});
      	google.setOnLoadCallback(initChart6);
      	
     	function displayData0(point) {
		data0.setValue(0, 0, 'PsiG');
		data0.setValue(0, 1, point);
		chart0.draw(data0, options0);
	   }
	    function displayData1(point) {
		data1.setValue(0, 0, 'PsiG');
		data1.setValue(0, 1, point);
		chart1.draw(data1, options1);
	   }
		function displayData2(point) {
		data2.setValue(0, 0, 'PsiG');
		data2.setValue(0, 1, point);
		chart2.draw(data2, options2);
	    }	
		function displayData3(point) {
		data3.setValue(0, 0, 'PsiD'); 
		data3.setValue(0, 1, point);
		chart3.draw(data3, options3);
	    }   
	    function displayData4(point) {
		data4.setValue(0, 0, 'MMcF/D'); //Adam 2014-01-20 Changed unit to MMcf/D from Mcf/D
		data4.setValue(0, 1, point);
		chart4.draw(data4, options4);
	    }   
		function displayData5(point) {
		data5.setValue(0, 0, 'PsiG');
		data5.setValue(0, 1, point);
		chart5.draw(data5, options5);
	    }  
 		function displayData6(point) {
		data6.setValue(0, 0, 'DegF');
		data6.setValue(0, 1, point);
		chart6.draw(data6, options6);
	    }  
	    
		function initChart0() {//Casing PsiG
		data0 = new google.visualization.DataTable();
		data0.addColumn('string', 'Label');
		data0.addColumn('number', 'Value');
		data0.addRows(1);     
	    chart0 = new google.visualization.Gauge(document.getElementById('chart0div'));
	    options0 = {width: 180, height: 180, min:0, max: 1000, minorTicks: 4, majorTicks: ['0','200','400', '600', '800', '1000']};
	    }
		function initChart1() {//Tubing PsiG
		data1 = new google.visualization.DataTable();
		data1.addColumn('string', 'Label');
		data1.addColumn('number', 'Value');
		data1.addRows(1);     
	    chart1 = new google.visualization.Gauge(document.getElementById('chart1div'));
	    options1 = {width: 180, height: 180, min:0, max: 1000, minorTicks: 4, majorTicks: ['0','200','400', '600', '800', '1000']};
	    }	    
		function initChart2() {//U/S PsiG
		data2 = new google.visualization.DataTable();
		data2.addColumn('string', 'Label');
		data2.addColumn('number', 'Value');
		data2.addRows(1);
        chart2 = new google.visualization.Gauge(document.getElementById('chart2div'));
        options2 = {min: 0, max: 500, width: 180, height: 180, minorTicks: 5, majorTicks: ['0','100','200','300','400','500']};
		}
		
	    function initChart3() {//Difference PsiD
		data3 = new google.visualization.DataTable();
		data3.addColumn('string', 'Label');
		data3.addColumn('number', 'Value');
		data3.addRows(1);
        chart3 = new google.visualization.Gauge(document.getElementById('chart3div'));
        options3 = { min: 0, max: 10, width: 180, height: 180, minorTicks: 5, majorTicks: ['1','2','3','4','5','6','7','8','9', '10']};
		}	
		
		function initChart4() {//Flow MMcf/Day
		data4 = new google.visualization.DataTable();
		data4.addColumn('string', 'Label');
		data4.addColumn('number', 'Value');
		data4.addRows(1);
        chart4 = new google.visualization.Gauge(document.getElementById('chart4div'));
        options4 = {min: 0, max: 1, width: 180, height: 180, minorTicks: 4, majorTicks: ['0','0.2','0.4','0.6', '0.8', '1.0']}; 
        //Adam 2014-01-20 Changed max to 1 from 1000, majorTicks to 0 - 1.0 from 0-1000
        }
		
		function initChart5() {//Line PsiG
		data5 = new google.visualization.DataTable();
		data5.addColumn('string', 'Label');
		data5.addColumn('number', 'Value');
		data5.addRows(1);
        chart5 = new google.visualization.Gauge(document.getElementById('chart5div'));
        options5 = {min: 0, max: 200, width: 180, height: 180, minorTicks: 5, majorTicks: ['0','50','100','150', '200']};
        }


		function initChart6() {//Temperature DegF
		data6 = new google.visualization.DataTable();
		data6.addColumn('string', 'Label');
		data6.addColumn('number', 'Value');
		data6.addRows(1);
        chart6 = new google.visualization.Gauge(document.getElementById('chart6div'));
        options6 = {min: 0, max: 100, width: 180, height: 180, minorTicks: 4, majorTicks: ['0','20', '40', '60', '80', '100']};
        }	
        
        
		$(document).ready(function() {
		    
		
		loadData();
		setInterval('loadData()', 5000);	
 
		});
		
		
		
	function loadData() {		
		var p;	// variable for the data point
		var d;	//date/time

		//New added March/24/2014, Adam >>>
		var s;
		var sv;
		var a;
		var av;
		//<<< New added March/24/2014, Adam  

		//added "location=true" parameter, this adds data.elevation integer which we use to determine Switch/Actuator status March/24/2014, Adam
		//RC8
		$.getJSON('https://api.thingspeak.com/channels/9707/feed/last.json?apikey=JZBLUMEFRFKYC4BR&location=true&callback=?', function(data) {
		//Adam's  test channel
		//$.getJSON('https://api.thingspeak.com/channels/10907/feed/last.json?apikey=D0OLVC3BFJSNJ4VE&location=true&callback=?', function(data) {
		


		p = data.field1;		// get the data point
					if (p)	{
					p = Math.round10(p,-1);
					displayData0(p);
						}
		p = data.field2;		// get the data point
					if (p)	{
					p = Math.round10(p,-1);
					displayData1(p);
						}				
		p = data.field3;		// get the data point
					if (p)	{
					p = Math.round10(p,-1);
					displayData2(p);
						}				
		p = data.field4;		// get the data point
					if (p)	{
					p = Math.round10(p,-1);
					displayData3(p);
						}
		p = data.field5;		// get the data point
					if (p)	{
					p = Math.round10(p,-1);
					displayData4(p);
						}
		p = data.field6;		// get the data point
					if (p)	{
					p = Math.round10(p,-1);
					displayData5(p);
						}
		p = data.field7;		// get the data point
					if (p)	{
					p = Math.round10(p,-1);
					displayData6(p);
						}						
		d=data.created_at;
                             	if (d) {
				document.getElementById('LastUpdate').innerHTML=jQuery.timeago(d);
				         	}
                //New added March/24/2014, Adam >>>
		p= data.elevation;
					if (p) {			
		s=(p & 2); { if(s==2) sv = "ENABLED"; else sv ="DISABLED"; }
		a=(p & 1); { if(a==1) av = "OPEN"; else av ="CLOSED"; }
		document.getElementById('SwitchingState').innerHTML=sv;        	
		document.getElementById('ActuatorState').innerHTML=av;    
		                            }
		//<<< New added March/24/2014, Adam  					         	
				         	
					});
	}


