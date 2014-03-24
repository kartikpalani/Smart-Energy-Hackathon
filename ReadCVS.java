import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.util.HashMap;
import java.util.Map;
import java.lang.Math;
import java.util.Arrays;
import java.util.Comparator;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.lang.*;
 
public class ReadCVS {
 
  public static void main(String[] args) {
 
	ReadCVS obj = new ReadCVS();
	obj.run();
 
  }
 
  public void run() {
	
	//input of data currently of SEIL lab
	//currently consumption data of ACs only considered with data coming in with granularity of 1 second
	//Modelling and Projections are done by aggregating above data for each hour
	String csvFile0 = "meter1_Jan6_Feb6.csv";
	BufferedReader br0 = null;
	BufferedWriter out = null;
	String line = "";
	String cvsSplitBy = ",";
	
	//Keeping a track of actual consumption, predicted consumption from previous days and modelled consumption based on slabs and price
	double [][]actual_consumption = new double[25][30];
	double [][]predicted_consumption = new double[25][30];
	double [][]cost_considered_consumption = new double[25][30];
	int [][]no_of_occupants = new int[25][30];
	
	//Considering schedule of occupants in room for giving higher weight to hours where occupancy is more proportionally
	for(int i=0; i<30; i++) {
		for(int j=0; j<24; j++) {
	no_of_occupants[j][i] = 1;
                                 }                            
                               }
							   
     for(int i=0; i<30; i++) {
		for(int j=0; j<24; j++) {
	no_of_occupants[24][i] += no_of_occupants[j][i];
                                 }                            
                               }
                               
	for(int i=0; i<30; i++) {
	actual_consumption[24][i] = 0;
	}
	
	for(int i=0; i<30; i++) {
	predicted_consumption[24][i] = 0;
	}
	
	for(int i=0; i<30; i++) {
	cost_considered_consumption[24][i] = 0;
	}
	
	double previous_consumption = 1088959.875;
	double current_consumption = 0;
	
	int hour_count = 0;
	int day_count = 0;
	int consumption_count = 1;
	
	int actual_index_row = 0;
	int actual_index_column = 0;
	int predicted_index_row = 0;
	int predicted_index_column = 0;
	int cost_index_row = 0;
	int cost_index_column = 0;
	
	double pred1_consumption = 0;
	double pred1_count = 0;
	
	double total_consumption = 0;
	
	//Modelling is done considering slabs, pricing in the slabs, previous consumption trends, the weighted averages, occupancy schedule, hourly priorities
	//Slabs based pricing is used for modelling the consumption
	//Basically we consider 5 slabs here
	//Each slab has an increasing rate of electricity price
	//User will have an option of within which slab he would like to restrict consumption 
	//Accordingly consumption for entire month will be modelled 
	//Learning from how the consumption has been so far the model gets updated 
	//The model for the entire month is updated after each hour based on how much has been consumed and quota left
	//There is actual consumption and modelled consumption for each hour which user will know prior to the hour 
	//But there will always be a discrepancy in the actual and modelled consumption 
	//This difference can be excess quota left due to lesser usage or a deficit since more than modelled consumption has been used 
	//The difference is then adjusted in the remaining hours of the month
	//If excess quota is left that is adjusted by adding some more consumption in future hours 
	//If there is a deficit that is adjusted by reducing the allotted consumption in future hours
	double slab1_consumption = 200000;
	double slab2_consumption = 400000;
	double slab3_consumption = 800000;
	double slab4_consumption = 1000000;
	double slab5_consumption = 1200000;
	
	//The electricity pricing for each slab
	double slab1_cost = 4;
	double slab2_cost = 4.5;
	double slab3_cost = 5;
	double slab4_cost = 5.5;
	double slab5_cost = 6;
	double current_cost = 4;
	
	//In real time the cost of electricity for previous hour is displayed
	//In real time the monthly bill so far is also displayed
	double hourly_calculated_cost = 0;
	double monthly_bill = 0;
	
	double consumption_difference = 0;
	double consumption_difference_hourly = 0;
	double basic_hourly_consumption = 277.78;
	double basic_daily_consumption = 6666.67;
	double aggregate_hourly_consumption = 0;
	double aggregate_daily_consumption = 0;
	double cost_aggregate_hourly_consumption = 0;
	double cost_aggregate_daily_consumption = 0;
	
	double cost_based_calculation1 = 0;
	double consumption_for_this_hour = 0;
	double additional_consumption = 0;
	double additional_consumption_previous = 0;
	
	int electricity_price = 1;
	
	double consumption_calculated_hourly_basic = 0;
	double consumption_calculated_daily = 0;
	double consumption_calculated_hourly_actual = 0;
	consumption_calculated_daily = (double) slab1_consumption / 30;
	consumption_calculated_hourly_basic = (double) consumption_calculated_daily / no_of_occupants[24][0];
	
	int overshoot_check1 = 0;
	int overshoot_check2 = 0;
	int overshoot_check3 = 0;
	int overshoot_check4 = 0;
	int overshoot_check5 = 0;
	
	//Based on above occupancy schedule the no. of occupants helps to give weights to the hours
	int occupants_till_now = 0;
	int occupants_remaining = 0;
	int hours_remaining = 0;
	int days_remaining = 0;
	int aggregate_occupants = 0;
	
	String slab = "Slab1";
	
	try {
 
		br0 = new BufferedReader(new FileReader(csvFile0));
		File file = new File("filename12.txt");
	
	// if file doesnt exists, then create it
			if (!file.exists()) {
				file.createNewFile();
			}
			
			FileWriter fw = new FileWriter(file.getAbsoluteFile());
			BufferedWriter bw = new BufferedWriter(fw);
			
		while ((line = br0.readLine()) != null) {
 			
 			try
				{
				Thread.sleep(1000);  
				}catch (InterruptedException ie)
			{
				System.out.println(ie.getMessage());
			} 
			
			//The data is aggregated to get the total consumption for each hour
 			if(consumption_count == 3600){
 			
 			consumption_count = 1;
 			
			String[] country = line.split(cvsSplitBy);
 			current_consumption = Double.parseDouble(country[30]);
 			
			actual_consumption[actual_index_row][actual_index_column] = current_consumption - previous_consumption;
 			
			//aggregate_hourly_consumption is value till before current hour
 			aggregate_hourly_consumption += actual_consumption[actual_index_row][actual_index_column];
 			//aggregate_daily_consumption is value till before current hour
 			aggregate_daily_consumption += actual_consumption[actual_index_row][actual_index_column];
 			
			//Checking if the aggregated consumption is crossing the designated slabs(for slabs 2,3,4 and 5)
 			if(aggregate_daily_consumption >= slab1_consumption && aggregate_daily_consumption < slab2_consumption && overshoot_check2 == 0){
 			//Check if slab1 has been crossed
			//If crossed user will be informed
			//Further consumption for remaining hours and nest remaining days is modelled based on new slab
			//days_remaining = 30 - actual_index_column;
 			consumption_calculated_daily = slab2_consumption - slab1_consumption;
 			for(int i=actual_index_column; i<30; i++){
 			aggregate_occupants += no_of_occupants[24][i];
 			}
 			consumption_calculated_hourly_basic = (double) consumption_calculated_daily / aggregate_occupants;
 			/*if(occupants_remaining > 0){
 			consumption_calculated_hourly_basic = (double) consumption_calculated_daily / occupants_remaining;
 			}
 			else{
			consumption_calculated_hourly_basic = (double) consumption_calculated_daily / no_of_occupants[24][actual_index_column];
 			}*/
 			slab = "Slab2";
 			overshoot_check2 = 1;
 			aggregate_occupants = 0;
 			current_cost = 4.5;
 			}
 			else if(aggregate_daily_consumption >= slab2_consumption && aggregate_daily_consumption < slab3_consumption && overshoot_check3 == 0){
 			//Check if slab2 has been crossed
			//If crossed user will be informed
			//Further consumption for remaining hours and nest remaining days is modelled based on new slab
			//days_remaining = 30 - actual_index_column;
 			consumption_calculated_daily = slab3_consumption - slab2_consumption;
 			for(int i=actual_index_column; i<30; i++){
 			aggregate_occupants += no_of_occupants[24][i];
 			}
 			consumption_calculated_hourly_basic = (double) consumption_calculated_daily / aggregate_occupants;
 			/*if(occupants_remaining > 0){
 			consumption_calculated_hourly_basic = (double) consumption_calculated_daily / occupants_remaining;
 			}
 			else{
			consumption_calculated_hourly_basic = (double) consumption_calculated_daily / no_of_occupants[24][actual_index_column];
 			}*/
 			slab =  "Slab3";
 			overshoot_check3 = 1;
 			aggregate_occupants = 0;
 			current_cost = 5;
 			}
 			else if(aggregate_daily_consumption >= slab3_consumption && aggregate_daily_consumption < slab4_consumption && overshoot_check4 == 0){
 			//Check if slab3 has been crossed
			//If crossed user will be informed
			//Further consumption for remaining hours and nest remaining days is modelled based on new slab
			//days_remaining = 30 - actual_index_column;
 			consumption_calculated_daily = slab4_consumption - slab3_consumption;
 			for(int i=actual_index_column; i<30; i++){
 			aggregate_occupants += no_of_occupants[24][i];
 			}
 			consumption_calculated_hourly_basic = (double) consumption_calculated_daily / aggregate_occupants;
 			/*if(occupants_remaining > 0){
 			consumption_calculated_hourly_basic = (double) consumption_calculated_daily / occupants_remaining;
 			}
 			else{
			consumption_calculated_hourly_basic = (double) consumption_calculated_daily / no_of_occupants[24][actual_index_column];
 			}*/
 			slab =  "Slab4";
 			overshoot_check4 = 1;
 			aggregate_occupants = 0;
 			current_cost = 5.5;
 			}
 			else if(aggregate_daily_consumption >= slab4_consumption && aggregate_daily_consumption < slab5_consumption && overshoot_check5 == 0){
 			//Check if slab4 has been crossed
			//If crossed user will be informed
			//Further consumption for remaining hours and nest remaining days is modelled based on new slab
			//days_remaining = 30 - actual_index_column;
 			consumption_calculated_daily = slab5_consumption - slab4_consumption;
 			for(int i=actual_index_column; i<30; i++){
 			aggregate_occupants += no_of_occupants[24][i];
 			}
 			consumption_calculated_hourly_basic = (double) consumption_calculated_daily / aggregate_occupants;
 			/*if(occupants_remaining > 0){
 			consumption_calculated_hourly_basic = (double) consumption_calculated_daily / occupants_remaining;
 			}
 			else{
			consumption_calculated_hourly_basic = (double) consumption_calculated_daily / no_of_occupants[24][actual_index_column];
 			}*/
 			slab =  "Slab5";
 			overshoot_check5 = 1;
 			aggregate_occupants = 0;
 			current_cost = 6;
 			}
 			else{
 			}
 			
 			//cost based what should be consumption in present hour
 			consumption_calculated_hourly_actual = consumption_calculated_hourly_basic * no_of_occupants[actual_index_row][actual_index_column]; 
 			consumption_for_this_hour = consumption_calculated_hourly_actual;
 			//System.out.println(consumption_calculated_hourly_actual);
 			
			//cost_aggregate_hourly_consumption is value till before current hour
 			//aggregating actual consumption for each day
			cost_aggregate_hourly_consumption += consumption_calculated_hourly_actual;
 			//cost_aggregate_daily_consumption is value till before current hour
 			//aggregating actual consumption for the entire month
			cost_aggregate_daily_consumption += consumption_calculated_hourly_actual;
 			consumption_calculated_hourly_actual = consumption_calculated_hourly_actual + additional_consumption;
 			additional_consumption_previous = additional_consumption;
 			//System.out.println(consumption_calculated_hourly_actual);
 			
			additional_consumption = 0;
 			
			//Aggregating the occupants for each hour for allotting weights to the hours
			occupants_till_now += no_of_occupants[actual_index_row][actual_index_column];
 			occupants_remaining = no_of_occupants[24][actual_index_column] - occupants_till_now;
 			//System.out.println(consumption_calculated_hourly_actual);
 			cost_considered_consumption[actual_index_row][actual_index_column] = consumption_calculated_hourly_actual - actual_consumption[actual_index_row][actual_index_column];
 			/*if(occupants_remaining > 0){
 			cost_based_calculation1 = (double) cost_considered_consumption[actual_index_row][actual_index_column] / occupants_remaining;
 			consumption_calculated_hourly_basic = consumption_calculated_hourly_basic + cost_based_calculation1;
 			}*/
 			additional_consumption = cost_considered_consumption[actual_index_row][actual_index_column];
 			
 			//FileWriter fstream = new FileWriter("test12.txt", true); //true tells to append data.
    		//out = new BufferedWriter(fstream);
			
			hourly_calculated_cost = actual_consumption[actual_index_row][actual_index_column] * current_cost;
			monthly_bill += hourly_calculated_cost;
			 
    		String result = String.valueOf(actual_index_column + 1) + "," + String.valueOf(actual_index_row + 1) + "," + Double.toString(consumption_calculated_hourly_actual) + "," + Double.toString(actual_consumption[actual_index_row][actual_index_column]) + "," + Double.toString(cost_aggregate_hourly_consumption) + "," + Double.toString(aggregate_hourly_consumption) + "," + Double.toString(slab1_consumption) + "," + Double.toString(slab2_consumption) + "," + Double.toString(slab3_consumption) + "," + Double.toString(slab4_consumption) + "," + Double.toString(slab5_consumption) + "," + Double.toString(aggregate_daily_consumption) + "," + slab + "," + Double.toString(hourly_calculated_cost) + "," + Double.toString(monthly_bill);
    			
    			hourly_calculated_cost = 0;
    			System.out.println(result);
    			bw.write(result + "\n");
			//bw.close();
			
    			//out.write("\n"+result);
    			//out.close();
    			
 			/*System.out.println(actual_consumption[actual_index_row][actual_index_column] + "," + aggregate_hourly_consumption + "," + aggregate_daily_consumption + "," + cost_aggregate_hourly_consumption + "," + cost_aggregate_daily_consumption + "," + consumption_for_this_hour + "," + additional_consumption_previous + "," + cost_considered_consumption[actual_index_row][actual_index_column]);*/
 			
 			//Previous days data and moving averages calculated to get trend of how the consumption for following day will be
			previous_consumption = current_consumption;
 			
 			if(actual_index_column > 0) {
 			for(int i=0; i<actual_index_column; i++) {
 				pred1_consumption += actual_consumption[actual_index_row][i];
 				pred1_count = pred1_count + 1;
 			}
 			pred1_consumption = (double) pred1_consumption / pred1_count;
 			predicted_consumption[actual_index_row][actual_index_column] = pred1_consumption;
 			pred1_consumption = 0;
 			pred1_count = 0;
 			}
 			else{
 			predicted_consumption[actual_index_row][actual_index_column] = 0;
 			}
 			
 			actual_index_row++;
 			
			//If one days data is processed and modelled some parameters are then updated
 			if(actual_index_row == 24) 
 			{
 			actual_index_row = 0;
 			actual_index_column++;
 			aggregate_hourly_consumption = 0;
 			cost_aggregate_hourly_consumption = 0;
 			consumption_difference_hourly = 0;
 			occupants_till_now = 0;
 			//consumption_calculated_hourly_basic = (double) consumption_calculated_daily / no_of_occupants[24][actual_index_column];
 			}
			
 			if((actual_index_row == 0) && (actual_index_column == 30)) break;
 			
 			}
 			
 			else {
 			consumption_count++;
 			}
		}  
 
	} catch (FileNotFoundException e) {
		e.printStackTrace();
	} catch (IOException e) {
		e.printStackTrace();
	} finally {
		if (br0 != null) {
			try {
				br0.close();
			} catch (IOException e) {
				e.printStackTrace();
			}
		}
	}
	
	//Aggregating actual consumption
	for(int i=0; i<30; i++) {
		for(int j=0; j<24; j++) {
	actual_consumption[24][i] += actual_consumption[j][i];
                                 }                            
                               }
	
	//Aggregating predicted consumption
     for(int i=0; i<30; i++) {
		for(int j=0; j<24; j++) {
	predicted_consumption[24][i] += predicted_consumption[j][i];
                                 }                            
                               }
							   
     for(int i=0; i<30; i++) {
	total_consumption += actual_consumption[24][i];                          
                               }
							   
	/*for(int i=0; i<24; i++) {
		for(int j=0; j<30; j++) {
	System.out.print(actual_consumption[i][j] + ",");
                                 }
     System.out.println();                            
                               }
     System.out.println();
          
     for(int i=0; i<24; i++) {
		for(int j=0; j<30; j++) {
	System.out.print(predicted_consumption[i][j] + ",");
                                 }
     System.out.println();                            
                               }
     System.out.println();
     
     for(int i=0; i<24; i++) {
		for(int j=0; j<30; j++) {
	System.out.print(cost_considered_consumption[i][j] + ",");
                                 }
     System.out.println();                            
                               }
     System.out.println();*/   
  }
 
}
