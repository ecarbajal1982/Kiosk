/*
 * Ext JS Library 2.0.2
 * Copyright(c) 2006-2008, Ext JS, LLC.
 * licensing@extjs.com
 * 
 * http://extjs.com/license
 */
 
 	//Global vars
	var FirstNameField;
	var LastNameField;
	var DeptField;
	var BuildingField;
	var RoomField;
	var TagField;
	var PurchaseDateField;
	var PurchaseByField;
	var MakeField;
	var ModelField;
	var SerialField; 
	var LocationField;
	var OperatingSystemField;
	var MacAddressField;
	var WirelessMacAddressField;
	var PrinterField;
	var NotesField;
	var InventoryCreateForm;
	var InventoryCreateWindow;

Ext.onReady(function(){
					 
	Ext.QuickTips.init();
	
	// function that saves inventory records (inline grid edit)
		function saveInventory(oGrid_event){
		   Ext.Ajax.request({   
			  waitMsg: 'Please wait...',
			  url: 'grid-paging-data.php',
			  method: 'POST',
			  params: {
				 task: "UPDATE", 
				 tag: oGrid_event.record.data.tag,
				 make: oGrid_event.record.data.make,
				 model: oGrid_event.record.data.model,
				 purchase_date: oGrid_event.record.data.purchase_date.format('Y-m-d'), // this time we'll format it thanks to ext
				 purchase_by: oGrid_event.record.data.purchase_by,
				 department: oGrid_event.record.data.department,
				 location: oGrid_event.record.data.location,				 
				 building: oGrid_event.record.data.building,
				 room: oGrid_event.record.data.room
			  }, 
			  success: function(response){							
				 var result=eval(response.responseText);
				 switch(result){
				 case 1:
					InventoryStore.commitChanges();   // changes successful, get rid of the red triangles
					InventoryStore.reload();          // reload our datastore.				 	
					break;					
				 default:
					Ext.MessageBox.alert('Uh uh...','We couldn\'t save...');
					break;
				 }
			  },
			  failure: function(response){
				 var result=response.responseText;
				 Ext.MessageBox.alert('error','could not connect to the database. retry later');		
			  }									    
		   });   
		 }
	
	
	// add inventory item from a form
		  function createInventory(){
			 if(isInventoryFormValid()){
			  Ext.Ajax.request({   
				waitMsg: 'Please wait...',
				url: 'grid-paging-data.php',
				method: 'POST',
				params: {
				  task: "ADD",
				  fname:			FirstNameField.getValue(),
				  lname:			LastNameField.getValue(),
				  department:		DeptField.getValue(),
				  building:			BuildingField.getValue(),
				  room:				RoomField.getValue(),	  
				  tag:      		TagField.getValue(),
				  purchase_date: 	PurchaseDateField.getValue().format('Y-m-d'),
				  purchase_by:		PurchaseByField.getValue(),
				  make:       		MakeField.getValue(),
				  model:			ModelField.getValue(),
				  serial:			SerialField.getValue(),
				  location:			LocationField.getValue(),
				  os:				OperatingSystemField.getValue(),
				  mac:				MacAddressField.getValue(),
				  wmac:				WirelessMacAddressField.getValue(),
				  printer:			PrinterField.getValue(),
				  notes:			NotesField.getValue()
				}, 
				success: function(response){              
				  var result=eval(response.responseText);
				  switch(result){
				  case 1:
					Ext.MessageBox.alert('Creation OK','The inventory item has been added successfully.');
					InventoryStore.reload();
					InventoryCreateWindow.hide();
					break;
				  default:
					Ext.MessageBox.alert('Warning','Could not add inventory item.');
					break;
				  }        
				},
				failure: function(response){
				  var result=response.responseText;
				  Ext.MessageBox.alert('error','could not connect to the database. retry later');         
				}                      
			  });
			} else {
			  Ext.MessageBox.alert('Warning', 'Your form is not valid!');
			}
		  }
		  
	 // edit inventory item using a form
	 	  function editInventory(){
			 
		  }
		  
	

		  
		  
	
	  // reset the add inventory form before opening it
		  function resetInventoryForm(){
			    FirstNameField.setValue(''),
				LastNameField.setValue(''),
				DeptField.setValue(''),
				BuildingField.setValue(''),
				RoomField.setValue(''),	  
				TagField.setValue(''),
				PurchaseDateField.setValue(''),
				PurchaseByField.setValue(''),
				MakeField.setValue(''),
				ModelField.setValue(''),
				SerialField.setValue(''),
				LocationField.setValue(''),
				OperatingSystemField.setValue(''),
				MacAddressField.getValue(''),
				WirelessMacAddressField.setValue(''),
				PrinterField.setValue(''),
				NotesField.setValue('')
		  }  
	
	  // check if the form is valid
		  function isInventoryFormValid(){
			  return(FirstNameField.isValid() && LastNameField.isValid() && DeptField.isValid() && BuildingField.isValid() && RoomField.isValid() && TagField.isValid()
			&& PurchaseDateField.isValid() && PurchaseByField.isValid() && MakeField.isValid() && ModelField.isValid() && SerialField.isValid() && LocationField.isValid()
			&& OperatingSystemField.isValid() && MacAddressField.isValid() && WirelessMacAddressField.isValid() && PrinterField.isValid() && NotesField.isValid());
		  }		  
		  
	  // display or bring forth the form
		  function displayFormWindow(){
			 if(!InventoryCreateWindow.isVisible()){
			   resetInventoryForm();
			   InventoryCreateWindow.show();
			 } else {
			   InventoryCreateWindow.toFront();
			 }
		  }	  
	
  
	// create the Data Store
		var InventoryStore = new Ext.data.Store({
				id: 'InventoryStore',
				remoteSort: true,
			// load using script tags for cross domain, if the data in on the same domain as
			// this page, an HttpProxy would be better
				proxy: new Ext.data.HttpProxy({
					url: 'grid-paging-data.php',
					method: 'POST'
			}),
				
			baseParams:{task: "LISTING"}, // this parameter is passed for any HTTP request

			// create reader that reads the records
			reader: new Ext.data.JsonReader({
				root: 'results',
				totalProperty: 'total',	 
				id: 'id'
			   },[ 
					{name: 'tag', type: 'int', mapping: 'tag'},
					{name: 'make', type: 'string', mapping: 'make'},
					{name: 'model', type: 'string', mapping: 'model'},
					{name: 'serial', type: 'string', mapping: 'serial'},
					{name: 'purchase_date', type: 'date', dateFormat: 'Y-m-d', mapping: 'purchase_date'},
					{name: 'purchase_by', type: 'string', mapping: 'purchase_by'},
					{name: 'department', type: 'string', mapping: 'department'},
					{name: 'fname', type: 'string', mapping: 'fname'},
					{name: 'lname', type: 'string', mapping: 'lname'},
					{name: 'location', type: 'string', mapping: 'location'},
					{name: 'building', type: 'string', mapping: 'building'},
					{name: 'room', type: 'string', mapping: 'room'},
					{name: 'os', type: 'string', mapping: 'os'},
					{name: 'mac', type: 'string', mapping: 'mac'},
					{name: 'wmac', type: 'string', mapping: 'wmac'},
					{name: 'printer', type: 'string', mapping: 'printer'},
					{name: 'notes', type: 'string', mapping: 'notes'}
	
			]),			
		 });	
		
		InventoryStore.setDefaultSort('tag', 'desc');
	
	//expander
		var InventoryExpander = new Ext.grid.RowExpander({
			tpl : new Ext.Template(
				'<br><table align="center" width="90%" cellpadding="5">',
				'<tr><td width="30%"><p><b>First Name:</b> {fname}</p></td>',
				'<td width="30%"><p><b>Serial:</b> {serial}</p></td>',
				'<td width="30%"><p><b>MAC:</b> {mac}</p></td></tr>',
				'<tr><td><p><b>Last Name:</b> {lname}</p></td>',
				'<td><p><b>OS:</b> {os}</p></td>',
				'<td><p><b>WMAC:</b> {wmac}</p></td></tr>',
				'<tr><td><p><b>Printer:</b> {printer}</p></td>',
				'<td><p><b>Notes:</b>{notes}</p></td></tr></table><br>'
			)
		});
	 
			
	// create row action to EDIT with a form
		var InventoryRowAction = new Ext.ux.grid.RowActions({
			actions:[{
				iconCls:'icon-edit-record',
				qtip:'Edit {tag}'
			}],
				widthIntercept:Ext.isSafari ? 4 : 2,
				id:'actions'
			});
			
		
	
    //date renderer	
		var my_grid_dateRenderer =  Ext.util.Format.dateRenderer('Y-m-d');
	
    // the column model 
		var InventoryColumnModel = new Ext.grid.ColumnModel([
			   InventoryExpander,
			   {id: 'topic', // id assigned so we can apply custom css (e.g. .x-grid-col-topic b { color:#333 })
			   header: "Tag", dataIndex: 'tag', sortable: true, width: 10,},
			   {header: "Make", dataIndex: 'make', sortable: true, width: 12,
							editor: new Ext.form.TextField({ //TextField editor - for an editable field add an editor
							//specify options
							allowBlank: false
							})},
			   {header: "Model", dataIndex: 'model', sortable: true, width: 20,
							editor: new Ext.form.TextField({ //TextField editor - for an editable field add an editor
							//specify options
							allowBlank: false
							})},
			   {header: "Room", dataIndex: 'room', sortable: true, width: 10,  
							editor: new Ext.form.NumberField({
							//specify options
							allowBlank: false,  //default is true (nothing entered)
							allowNegative: false, //could also use minValue
							maxValue: 1000
							})},
			   {header: "Building", dataIndex: 'building', sortable: true, width: 10,
							editor: new Ext.form.ComboBox({ //dropdown based on client side data (from html)
							typeAhead: true,
							allowBlank: false,
							triggerAction: 'all',
							transform:'building',//look for this id to transform the html option values to a dropdown
							lazyRender:true,//prevents combo box from rendering until requested, should always be true for editor
							listClass: 'x-combo-list-small' //css class to apply to the dropdown list element
							})},
			   {header: "Department", dataIndex: 'department', sortable: true, width: 20,
							editor: new Ext.form.ComboBox({ //dropdown based on client side data (from html)
							typeAhead: true,
							allowBlank: false,
							triggerAction: 'all',
							transform:'department',//look for this id to transform the html option values to a dropdown
							lazyRender:true,//prevents combo box from rendering until requested, should always be true for editor
							listClass: 'x-combo-list-small' //css class to apply to the dropdown list element
							})},
			   {header: "Purchase Date", dataIndex: 'purchase_date', sortable: true, width: 20,
							editor: new Ext.form.DateField({ //DateField editor
							//specify options
							allowBlank: false,  //default is true (nothing entered)
							format: 'Y-m-d',//defaults to 'm/d/y', if there is a renderer 
							})
							,renderer: my_grid_dateRenderer					 
							},
			   {header: "Purchased By", dataIndex: 'purchase_by', sortable: true, width: 20,
							editor: new Ext.form.ComboBox({ //dropdown based on client side data (from html)
							typeAhead: true,
							allowBlank: false,
							triggerAction: 'all',
							transform:'purchase_by',//look for this id to transform the html option values to a dropdown
							lazyRender:true,//prevents combo box from rendering until requested, should always be true for editor
							listClass: 'x-combo-list-small' //css class to apply to the dropdown list element
							})},
			   {header: "Location", dataIndex: 'location', sortable: true, width: 10,
							editor: new Ext.form.ComboBox({ //dropdown based on client side data (from html)
							typeAhead: true,
							allowBlank: false,
							triggerAction: 'all',
							transform:'location',//look for this id to transform the html option values to a dropdown
							lazyRender:true,//prevents combo box from rendering until requested, should always be true for editor
							listClass: 'x-combo-list-small' //css class to apply to the dropdown list element
							})},
							InventoryRowAction //displays edit icon in its own column
		]);
	
		InventoryColumnModel.defaultSortable = true;
	 	 

    // Grid panel
		var InventoryListingEditorGrid = new Ext.grid.EditorGridPanel({
			id: 'InventoryListingEditorGrid',
			viewConfig: {
				forceFit:true
			},
			el:'topic-grid',
			width: 765,
			height: 550,
			enableColLock:false,
			clicksToEdit:2,//number of clicks to activate cell editor, default = 2        
			store: InventoryStore,
			cm: InventoryColumnModel,
			plugins: [InventoryExpander,InventoryRowAction],
			collapsible: true,
			animCollapse: false,
			title: 'College of Arts &amp; Letters Inventory',
			iconCls: 'icon-grid',

			//paging
			bbar: new Ext.PagingToolbar({
					store: InventoryStore,
					pageSize: 25,
					displayInfo: true,
					displayMsg: 'Displaying records {0} - {1} of {2}',
					emptyMsg: "No records to display"
			}),
			
			tbar: [
			 {
				text: 'Add Inventory',
				tooltip: 'Add an inventory item ',
				iconCls:'add',                      // reference to our css
				handler: displayFormWindow
          	}, '-',  // search
				'Search', ' ',
				new Ext.app.SearchField({
					store: InventoryStore
				})
			]	
			
		});
		
		
		
	//Row action event handler, pops up edit form with loaded row entry 
		InventoryRowAction.on('action', function(grid, record, action, row, col) {
				//Ext.ux.Toast.msg('Event: action', 'You have clicked row: <b>{0}</b>, action: <b>{1}</b>', row, action);
		  		 //launch form to update
				 Ext.getCmp("inventorycreateform").getForm().loadRecord(record);
				 
				 

		}); 

		

    // trigger the data store load
		InventoryStore.load({params:{start:0, limit:25}});
	
	// render it
		InventoryListingEditorGrid.render();	
		InventoryListingEditorGrid.on('afteredit', saveInventory);

				
	// define form fields
		FirstNameField = new Ext.form.TextField({
			id: 'FirstNameField',
			fieldLabel: 'First Name',
			maxLength: 20,
			allowBlank: false,
			anchor : '95%',
			maskRe: /([a-zA-Z0-9\s]+)$/
		});
			
		LastNameField = new Ext.form.TextField({
			id: 'LastNameField',
			fieldLabel: 'Last Name',
			maxLength: 20,
			allowBlank: false,
			anchor : '95%',    
			maskRe: /([a-zA-Z0-9\s]+)$/  
		});		
		
		DeptField = new Ext.form.ComboBox({
			 id:'DeptField',
			 fieldLabel: 'Department',
			 store:new Ext.data.SimpleStore({
			   fields:['department', 'deptName'],
			   data: [['cal','College of Arts & Letters'],['art','Art'],['comm','Communication'],['eng','English'],['lib','Liberal Studies'],
					['mus','Music'],['phil', 'Philosophy'],['rvf','RVF Museum'],['theatre','Theatre'],['wl','World Languages']]
			   }),
			 mode: 'local',
			 displayField: 'deptName',
			 allowBlank: false,
			 valueField: 'department',
			 anchor:'55%',
			 triggerAction: 'all'
      	});
		
		BuildingField = new Ext.form.ComboBox({
			 id:'BuildingField',
			 fieldLabel: 'Building',
			 store:new Ext.data.SimpleStore({
			   fields:['building', 'buildingName'],
			   data: [['ce','CE'],['fo','FO'],['pa','PA'],['pl','PL'],['uh','UH'],['va','VA']]
			   }),
			 mode: 'local',
			 displayField: 'buildingName',
			 allowBlank: false,
			 valueField: 'building',
			 anchor:'55%',
			 triggerAction: 'all'
      	});
		
		RoomField = new Ext.form.TextField({
			id:'RoomField',
			fieldLabel: 'Room',
			allowNegative: false,
			allowBlank: false,
			anchor:'55%',			
			maskRe: /([a-zA-Z0-9\.\s])/
		});
		
		TagField = new Ext.form.NumberField({
			id:'TagField',
			fieldLabel: 'Tag',
			maxLength: 5,
			allowNegative: false,
			allowBlank: false,
			anchor:'55%'
		});


		PurchaseDateField = new Ext.form.DateField({
			id:'PurchaseDateField',
			fieldLabel: 'Purchase Date',
			format : 'Y-m-d',
			allowBlank: false,
			anchor:'55%'
		});				
		
		PurchaseByField = new Ext.form.ComboBox({
			 id:'PurchaseByField',
			 fieldLabel: 'Purchased By',
			 store:new Ext.data.SimpleStore({
			   fields:['purchase_by', 'PurchaseByName'],
			   data: [['college','College'],['dept','Department']]
			   }),
			 mode: 'local',
			 displayField: 'PurchaseByName',
			 allowBlank: false,
			 valueField: 'purchase_by',
			 anchor:'55%',
			 triggerAction: 'all'
      	});
		
		MakeField = new Ext.form.TextField({
			id: 'MakeField',
			fieldLabel: 'Make',
			maxLength: 30,
			allowBlank: false,
			anchor : '95%',    
			maskRe: /([a-zA-Z0-9\s]+)$/  
		});
		
		ModelField = new Ext.form.TextField({
			id: 'ModelField',
			fieldLabel: 'Model',
			maxLength: 30,
			allowBlank: false,
			anchor : '95%',    
			maskRe: /([a-zA-Z0-9\s]+)$/  
		});
		
		SerialField = new Ext.form.TextField({
			id: 'SerialField',
			fieldLabel: 'Serial',
			maxLength: 30,
			allowBlank: false,
			anchor : '95%',    
			maskRe: /([a-zA-Z0-9\s]+)$/  
		});
		
		LocationField = new Ext.form.ComboBox({
			 id:'LocatoinField',
			 fieldLabel: 'Location',
			 store:new Ext.data.SimpleStore({
			   fields:['location', 'LocationName'],
			   data: [['on','On Campus'],['off','Off Campus'],['sur','Surplus']]
			   }),
			 mode: 'local',
			 displayField: 'LocationName',
			 allowBlank: false,
			 valueField: 'location',
			 anchor:'55%',
			 triggerAction: 'all'
      	});
		
		OperatingSystemField = new Ext.form.TextField({
			id: 'OperatingSystemField',
			fieldLabel: 'Operating System',
			maxLength: 30,
			allowBlank: true,
			anchor : '95%',    
			maskRe: /([a-zA-Z0-9\s\.]+)$/  
		});
		
		MacAddressField = new Ext.form.TextField({
			id: 'MacAddressField',
			fieldLabel: 'Mac Address',
			maxLength: 12,
			allowBlank: true,
			anchor : '55%',    
			maskRe: /([a-z0-9\s]+)$/  
		});
		
		WirelessMacAddressField = new Ext.form.TextField({
			id: 'WirelessMacAddressField',
			fieldLabel: 'Wireless Mac Address',
			maxLength: 12,
			allowBlank: true,
			anchor : '55%',    
			maskRe: /([a-z0-9\s]+)$/  
		});
		
		PrinterField = new Ext.form.TextField({
			id: 'PrinterField',
			fieldLabel: 'Printer',
			maxLength: 30,
			allowBlank: true,
			anchor : '95%',    
			maskRe: /([a-zA-Z0-9\s]+)$/  
		});
		
		NotesField = new Ext.form.TextArea({
			id: 'NotesField',
			fieldLabel: 'Notes',
			maxLength: 100,
			allowBlank: true,
			anchor : '95%',    
			maskRe: /([a-zA-Z0-9\s]+)$/  
		});
		
		
		
	//create a generic inventory form	
		InventoryCreateForm = new Ext.FormPanel({
			id: 'inventorycreateform',
			labelAlign: 'left',
			labelWidth: 95,
			bodyStyle:'padding:5px 5px 0',
			autoScroll: true,
			width: 480,        
				items: [{
					xtype:'fieldset',
					title: 'User Information',
					autoHeight:true,
					collapsible: false,
						items: [FirstNameField, LastNameField, DeptField, BuildingField, RoomField]
				},{	
					xtype:'fieldset',
					title: 'Item Information',
					autoHeight:true,
					collapsible: false,
						items: [TagField, PurchaseDateField, PurchaseByField, MakeField, ModelField, SerialField, LocationField, OperatingSystemField, MacAddressField, WirelessMacAddressField]
				},{	
					xtype:'fieldset',
					title: 'Additional Information',
					autoHeight:true,
					collapsible: false,
						items: [PrinterField, NotesField]
				}]
		});
		
  
  	//create window for add inventory using the generic form + buttons 
		InventoryCreateWindow = new Ext.Window({
			  id: 'InventoryCreateWindow',
			  title: 'Add an inventory item',
			  closable:true,
			  width: 500,
			  height: 550,
			  plain:true,
			  layout: 'fit',
			  items: InventoryCreateForm,

			  buttons: [{
				  text: 'Save and Close',
				  handler: createInventory
				},{
				  text: 'Cancel',
				  handler: function(){
					// because of the global vars, we can only instantiate one window... so let's just hide it.
					InventoryCreateWindow.hide();
				  }
				}]
		});
			
		
			
	
	
	
});


