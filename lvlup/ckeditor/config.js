/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.entities = false;
	config.extraPlugins = 'imageuploader';
	
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];
	
	
	config.removeButtons = 'Save,NewPage,Preview,Templates,Radio,Checkbox,Form,TextField,Textarea,Button,Select,ImageButton,HiddenField,CreateDiv,Flash';
	config.forcePasteAsPlainText = true;
	config.entities = false;
	CKEDITOR.on( 'instanceReady', function( ev )    {
		var editor = ev.editor,
		dataProcessor = editor.dataProcessor,
		htmlFilter = dataProcessor && dataProcessor.htmlFilter;
      
    // Output self closing tags the HTML4 way, like <br>.
    //dataProcessor.writer.selfClosingEnd = '>';

    // Output dimensions of images as width and height
    htmlFilter.addRules({
		elements :{
			$ : function( element ){
			if ( element.name == 'img' ){
				var style = element.attributes.style;

				if ( style ){
					// Get the width from the style.
					var match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec( style ),
					width = match && match[1];

					// Get the height from the style.
					match = /(?:^|\s)height\s*:\s*(\d+)px/i.exec( style );
					var height = match && match[1];


					if ( height ){
						element.attributes.style = element.attributes.style.replace( /(?:^|\s)height\s*:\s*(\d+)px;?/i , '' );
						element.attributes.height = height;
					}

					if ( width ){
              
						element.attributes.style = element.attributes.style.replace( /(?:^|\s)width\s*:\s*(\d+)px;?/i , '' );
                
						if (width > 800){   
							var new_height = (((800*100)/width)/100);
							element.attributes.width = 800;
							element.attributes.height = (Math.ceil(height*new_height));
						}else{
							element.attributes.width = width;
						}
			
					}


				}
			}


			if ( !element.attributes.style || !element.attributes.style.replace(/^\s*([\S\s]*?)\s*$/, '$1').length )
				delete element.attributes.style;

				return element;
		}
      }
    } );
    
    });
};
