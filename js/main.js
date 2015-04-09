/**
 * Main JS Author : Hoja M A
 */
$(document).ready(function(){
	$('.nonimagesuppliers').dataTable();
	$('.imagesuppliers').dataTable();
	
	//Migration Button Event Binds Here
	$('.migrate').on('click',function(){
	  var dpSup = $('.duplicateSupplier option:selected').text();
	  var ogSup = $('.originalSupplier option:selected').text();
	  if( $('.duplicateSupplier option:selected').val() === $('.originalSupplier option:selected').val()){
	    alert("Same Suppliers Selected !!");
	    return false;
	  }
	  return confirm("Are you sure want to delete "+dpSup+" supplier and replace it with "+ogSup+" supplier");
	});
});
