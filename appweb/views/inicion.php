	<h1>Welcome/Bienvenido a VNX Codeigniter</h1>
	<div id="body">
	</div>
	<p class="footer">Ejemplo de tabla, con datatables y campos input con selects:</p>
	<?php
		echo br().PHP_EOL;  // genera neuva linea en codigo html al navegador
		echo form_fieldset('titulo marco',array('class'=>'containerin ') );
		$this->table->clear();
		    // si se quiere data tables se debe pasar algo o definir/invocar "set_datatables"
		$this->table->set_datatables( array("fixedColumns"=>TRUE) );
		    // para definir bordes, se debe proveer un template con border=1 o pasar en el mismo una clase/estilo css
			$this->table->set_template(array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="2" class="table">','cell_start' => '<td class="btn-large">' ) );
			$this->table->set_heading('col1: ','col2');
			$this->table->add_row('celda y alla campo select autogenerado:', form_dropdown('cod_subcategoria', array('1', '2', 'otr'),null,'id="list_subcategoria"'));
			$this->table->add_row('celda tabla2: ','otra celsa22');
			$this->table->add_row('celda tabla3: ','otra celsa23');
			$this->table->add_row('celda tabla2: ','otra celsa22');
			$this->table->add_row('celda tabla3: ','otra celsa23');
			$this->table->add_row('celda tabla2: ','otra celsa22');
			$this->table->add_row('celda tabla3: ','otra celsa23');
			$this->table->add_row('celda tabla2: ','otra celsa22');
			$this->table->add_row('celda tabla3: ','otra celsa23');
			$this->table->add_row('celda tabla4: ','otra celsa24');
		echo $this->table->generate();
		echo form_hidden('campooculto','valoroculto').br().PHP_EOL;
		echo form_submit('nombreboton', 'boton enviar', 'class="btn-primary btn"');
		echo form_fieldset_close() . PHP_EOL;
	?>
	</div>
