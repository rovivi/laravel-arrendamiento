
<?php
//bird es dice que clase de nombramiento 
//extras es la empresa que o dependencia
setlocale(LC_TIME, "es_ES");

//require 'conectorsql.php';
//session_start();

//array("Volvo", "BMW", "Toyota");

$idcontrato =1;
//$contrato = Alumnos::getcontrato($idcontrato);
//$services = Alumnos::getAllservice();
//$serviceshere = Alumnos::getAllserviceincontrat($idcontrato);
//$places = Alumnos::getAllplace();
//$placeshere = Alumnos::getAllplaceincontrat($idcontrato);
$numcontrato =2;

$strplace="Str LUgare";//stringdelugares($placeshere,$places);
$costoservicios=10;
$costoinmuebles=10;
//$ME = $_SESSION['User'];  Gestor

/*if ($contrato['birth']=='Acta constitutiva'){
$strnobramiento ="REPRESENTANTE LEGAL DE ";
}
else {
$strnobramiento="TILTULAR DE ";
}*/
$strnobramiento="TILTULAR DE ";


//se realizan los descuentos de los servicios 
$costoservicios=10;
$costoinmuebles=10;



//require_once('');
include(app_path() . '/tcpdf1/pdf2/tcpdf.php');


function bu($str){
return'<b><u>'.$str.'</u></b>';
}




function arraydecostos($placeshere,$places){
	//array de 2 dimenciones don de el index 0 sera el preci� y el index 1 la cantidad si no existe el producto ob�imente no se agraga
$arraydeids =[];
            for ($i = 0; $i < count($placeshere); $i++) {
                array_push($arraydeids,$placeshere[$i]['idservice']);
            }
$array2= [];
			for ($i = 0; $i < count($places); $i++) {			
				$key = array_search($places[$i]['idservice'],$arraydeids);
				if( $key !== false ) {
//				$key2 = array_search($places[$i]['idplace'],$placeshere);
				array_push($array2, [$places[$i]['price'],$placeshere[$key]['count']]);
				} 
}	
return $array2;
}
function arraydecostos2($placeshere,$places){
	//array de 2 dimenciones don de el index 0 sera el preci� y el index 1 la cantidad si no existe el producto ob�imente no se agraga
$arraydeids =[];
            for ($i = 0; $i < count($placeshere); $i++) {
                array_push($arraydeids,$placeshere[$i]['idplace']);
            }
$array2= [];
			for ($i = 0; $i < count($places); $i++) {			
				$key = array_search($places[$i]['idplace'],$arraydeids);
				if( $key !== false ) {
//				$key2 = array_search($places[$i]['idplace'],$placeshere);
				array_push($array2, [$places[$i]['price'],$placeshere[$key]['count']]);
				} 
}	
return $array2;
}




function stringdelugares($placeshere,$places){
	$strplaces='';
	$arraydeids =[];
            for ($i = 0; $i < count($placeshere); $i++) {
                array_push($arraydeids,$placeshere[$i]['idplace']);
            }
			for ($i = 0; $i < count($places); $i++) {			
				$key = array_search($places[$i]['idplace'],$arraydeids);
				if( $key !== false ) {
				$strplaces.=($places[$i]['name'].',');
				} 
}	
return substr(strtoupper($strplaces), 0,-1);
}




function sumatotal($array){
$total =0;
    for ($i = 0; $i < count($array); $i++) {
    		$total+=$array[$i][0]*$array[$i][1];
    	}
return round($total,0);
}




class MYPDF extends TCPDF {

	protected $numc='0';


	public function setcc($a) {
		$this->numc=$a;
	}
	//Page header
	public function Header() {
		// Logo		
		
		//$pdf->Image('images/image_demo.jpg', '', '', 40, 40, '', '', '', false, 300, '', false, false, 1, false, false, false);
		//$this->Image('logoc.png', 10, 0, 55, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		//$this->Image('escudo-Gray.png', 170, 7, 13, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('Carlito', '', 12);
		$this->SetY(22);
		// Title
		$this->Cell(0, 15,'CONTRATO No '.$this->numc, 0, false, 'C', 0, '', 0, false, 'M', 'M');
	}
	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('Carlito', '', 10);
		// Page number
		$this->Cell(0, 14, '  P�gina '.$this->getAliasNumPage().' de '.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ceconexpo');
$pdf->SetTitle('Contrato #.'.$numcontrato);

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(20, 32,23);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

$pdf->setcc('1');
// add a page
$pdf->AddPage();

// set some text to print


//$ifservice='<br><br>En lo que se refiere a la prestaci�n de servicio de alimentos y bebidas <b>�LA ARRENDADORA�</b> se obliga a cumplir con las leyes que regulen las actividades de alimentos y bebidas y otorgar� lo servicios para '.bu($contrato['peoplefood']).' personas, durante la realizaci�n del evento '.bu($contrato['namevent']).' en el (los) '.bu($contrato['date2']).' en el �rea arrendada de las '.bu(substr($contrato['time3'], 0, -3)).' horas, a las '.bu(substr($contrato['time4'], 0, -3)).' horas, exclusivamente. Por este concepto <b>�LA ARRENDATARIA�</b>, se compromete a pagar la cantidad de $'.bu($costoservicios).'(M.N), Mas el impuesto al valor agregado. Dicha prestaci�n de servicio consistir� en las especificaciones a que se refiere el anexo A del presente contrato y que forma parte integrante del mismo, en la inteligencia de que las especificaciones no se�aladas por <b>�LA ARRENDATARIA�</b> en el mencionado anexo a la firma del presente instrumento, no representan responsabilidad alguna para <b>�LA ARRENDADORA�</b> por dichas omisiones.';	
//if ($contrato['peoplefood']==0){$ifservice=$contrato['peoplefood'];}*/
$ifservice='owoowow';

$html = '<span style="text-align:justify;">
<br><br>2.-<b> DECLARA �LA ARRENDATARIA�</b>

<br><br>2.1.- Que su registro federal de contribuyentes: <b></b>

<br><br>2.2.- Que no se encuentra en los supuestos de impedimento para la celebraci�n de contratos que se�ala el art�culo 32 de la Ley de Adquisici�n, arrendamiento, y Prestaci�n de Servicios Relacionados con Bienes Muebles e Inmuebles del Estado de Michoac�n de Ocampo.

<br><br>2.3. Que conoce el inmueble y acepta recibir en arrendamientos el mismo, en las condiciones que se encuentra actualmente.

<br><br>2.4. Que tiene su domicilio para todos los efectos legales derivados del presente contrato en <b><u> </u></b>

<br><br><b>3.- DECLARAN �LAS PARTES�:</b>

<br><br>3.1. Que �las partes� reconocen la personalidad y/o personer�a con que comparecen a la celebraci�n del presente contrato de arrendamiento y/o prestaci�n de servicios de alimentos y bebidas, est�n conformes en cumplir y hacer cumplir lo que se consigna, de acuerdo al contenido de las anteriores condiciones comprendidas en las siguientes:
<br><br>
<span style="text-align:center;">
<center><h2>C L � U S U L A S:</h2></center></span>



<br><br>Por lo que respecta a la forma de pago que corresponde al arrendamiento y a la prestaci�n de servicio de alimentos y bebidas, deber� ser cubierto de la siguiente manera;<u><b> EL CLIENTE PAGAR�</b></u> A LA VUELTA DE LA FACTURA�, en el domicilio de <b>�LA ARRENDADORA�</b>, que quedo se�alado en la declaraci�n 1.6 del presente acuerdo de voluntades, mismo que manifiesta conocer.

<br><br>As� mismo, para el caso de que <b>�LA ARRENDATARIA�</b>, requiere la prestaci�n de alg�n servicio adicional, lo solicitar� con anticipaci�n y por escrito <b>�LA ARRENDADORA�</b>, qui�n determinar� el costo del servicio adicional, cotiz�ndolo separadamente de la totalidad del arrendamiento y/o prestaci�n de servicios de alimentos y bebidas contratados, realiz�ndose el contrato respectivo.

<br><br>El pago tendr� que ser <b>CUBIERTO EN SU TOTALIDAD</b>, con un m�nimo de <b>8 (ocho) d�as</b> de anticipaci�n al evento; de manera que, de no cumplirse esta disposici�n, el Centro de Convenciones de Morelia dar� por cancelado la realizaci�n del evento; de igual forma, no se har� devoluci�n por los adelantos que se hubiesen hecho en su momento.

<br><br><b>SEGUNDA.- DEL DEP�SITO DE LA GARANT�A.- �LA ARRENDATARIA�</b> entregar� el pago en garant�a de la siguiente manera: se entregara la cantidad de $
<br><br>Este dep�sito por ning�n motivo ser� aplicable al pago de arrendamiento. En caso de tratarse de arrendamiento exclusivamente del �rea, se cotizar� separadamente su equipamiento. Asimismo, cualquier modificaci�n al alcance de suministro por parte de <b>�LA ARRENDADORA�</b>, a petici�n expresa del cliente, alterara substancialmente la liquidaci�n final, misma que quedar� sujeta a eventuales cambios.

<br><br><b>CUARTA.- PERMISOS Y AUTORIZACIONES.- �LA ARRENDATARIA�</b> cubrir� y tramitar�, por su cuenta todos permisos, licencias y de m�s requisitos que las autoridades correspondientes exijan en relaci�n con la actividad comercial o eventos que se desarrollen en el �rea materia del presente contrato.

<br><br><b>QUINTA.- DESTINO.- �LA ARRENDATARIA�</b>, se obliga a destinar el �rea arrendada �nica y exclusivamente para lo cual fue contratada no pudiendo <b>�LA ARRENDATARIA�</b> darle un uso distinto a lo pactado.

<br><br>Igualmente, por ning�n motivo o concepto, podr� usar �reas o espacios mayores que los expresamente autorizados en este contrato. Asimismo, queda expresamente prohibido y convenido, que <b>�LA ARRENDATARIA�</b> por ning�n motivo podr� almacenar sustancias o elementos explosivos, corrosivos, inflamables o cualquier otro que puedan perjudicar al inmueble o a terceras personas, as� como tampoco sustancias prohibidas por la ley.

<br><br><b>�LA ARRENDATARIA�</b> acepta que el Centro de Convenciones de Morelia a trav�s de sus representantes y/o trabajadores pueda, en cualquier momento, ya sea antes o durante la realizaci�n del evento, tener acceso a las �reas contratadas, con el objeto de revisar, supervisar, operar y mantener las instalaciones y equipo para el buen servicio y funcionamiento, <b>�LA ARRENDATARIA�</b> est� obligada, en eventos masivos y/o dada la importancia del evento, a contratar Seguridad necesaria, con la finalidad de garantizar la integridad de su evento, en caso de ser requerido por <b>�LA ARRENDADORA�</b>.

<br><br><b>SEXTA.- �LA ARRENDADORA�</b> no ser� responsable para con <b>�LA ARRENDATARIA�</b> de ninguna perdida, da�o, robo o lesiones que pueda sufrir la misma en el inmueble arrendado o las personas que se encuentren en �l; los que estar�n bajo la plena y absoluta responsabilidad de <b>�LA ARRENDATARIA�</b>, tampoco ser� responsable <b>�LA ARRENDADORA�</b> de da�os ocasionados por causas imputables o no a <b>�LA ARRENDATARIA�</b>.

<br><br>Asimismo, <b>�LA ARRENDADORA�</b> se reserva el derecho de proporcionar el servicio por concepto de la prestaci�n de alimentos y bebidas dentro de las �reas arrendadas. Dicho servicio ser�n exclusivamente operados por el Centro de Convenciones de Morelia, con excepci�n de los Servicios que las partes convengan y que se�alen en el anexo �A� del presente contrato.

<br><br><b>S�PTIMA.- DE LA CESI�N.-</b> Queda expresamente prohibido a <b>�LA ARRENDATARIA�</b>, transferir o ceder los derechos y obligaciones en todo o en parte con terceras personas derivados del presente contrato, bajo la pena de pagar los da�os y perjuicios que se hayan ocasionado.

<br><br><b>OCTAVA.- LITIGIOS.- �LA ARRENDATARIA�</b>, asumir� toda la responsabilidad de los litigios que terceras personas promuevan en su contra, por causas imputables a ella, as� mismo, �LA ARENDATARIA� debe entregar la localidad libre de cualquier responsabilidad o reclamaci�n de car�cter laboral, administrativo o de cualquier otra obligaci�n frente a terceros, propia de la misma.

<br><br><b>NOVENA.-</b> Las partes acuerdan que <b>�LA ARRENDATARIA�</b> se obliga a conservar en buen estado el inmueble y de dar aviso inmediato a <b>�LA ARRENDADORA�</b> de cualquier situaci�n que pudiera afectar al mismo, en caso contrario ser� responsable de los da�os y perjuicios que pudieran ocasionarse por este motivo.

<br><br><b>D�CIMA.- DE LAS PENAS CONVENCIONALES.-</b> En caso de que <b>�LA ARRENDATARIA�</b> cancele el arrendamiento y/o prestaci�n de servicio de alimentos y bebidas materia del presente contrato se le aplicaran las siguientes penas convencionales:

<br><br>a).- Si la cancelaci�n se realiza 30 d�as naturales antes de la fecha se�alada para la realizaci�n del evento, <b>�LA ARRENDADORA�</b> aplicar�, como una pena convencional, el 30 % del monto total contratado.

<br><br>b).- Si la cancelaci�n se realiza 15 d�as naturales antes de la fecha se�alada para la realizaci�n del evento, <b>�LA ARRENDADORA�</b> aplicar�, como pena convencional, el 60 % del monto total contratado.

<br><br>c).- Si la cancelaci�n se realiza de 1 a 6 d�as naturales antes de la fecha se�alada para la realizaci�n del evento, <b>�LA ARRENDADORA�</b> aplicara, como pena convencional, el 100% del monto total contratado.

<br><br>d).- Si la cancelaci�n la solicita el Centro de Convenciones de Morelia, este reintegrara la cantidad total o el anticipo que se haya depositado para la realizaci�n del evento contratado.

<br><br>Para el caso en que <b>�LA ARRENDATARIA�</b> no cubriere en tiempo y forma el saldo que corresponde por concepto de la totalidad del precio del arrendamiento y/o prestaci�n de servicio de alimentos y bebidas.

<br><br><b>�LA ARRENDADORA�</b>, tendr� la facultad sin requerimiento previo, de dejar sin efectos legales o administrativos el siguiente acuerdo de voluntades, negando el acceso al inmueble arrendado, sin ocasionar con esto, da�os o perjuicios ocasionados a <b>�LA ARRENDATARIA�</b> o terceras personas, por no ser imputables a <b>�LA ARRENDADORA�</b>.

<br><br><b>D�CIMA PRIMERA.-</b> en caso de que el �rea arrendada sea utilizada para la realizaci�n de un evento de car�cter lucrativo, <b>�LA ARRENDATARIA�</b> se compromete a solicitar y tramitar, ante las autoridades correspondientes, los permisos necesarios para la realizaci�n del evento. Permiso que deber� presentar oportunamente a <b>�LA ARRENDADORA�</b>, as� mismo las multas, sanciones o cualquier otro gasto que se origine por dicha omisi�n, ser� a cargo de �LA ARRENDATARIA�, pagando los da�os y perjuicios que esto pudiera ocasionar.

<br><br><b>D�CIMA SEGUNDA.-</b> De igual forma <b>�LA ARRENDATARIA�</b> se deber� sujetar a las normas, reglamentos y leyes previamente establecidas por las autoridades competentes sobre el consumo de bebidas alcoh�licas y horarios para la verificaci�n de eventos.

<br><br><b>D�CIMA TERCERA.- �LA ARRENDATARIA�</b> se obliga a responder civil y penalmente de los da�os y perjuicios que pudieran causarle a <b>�LA ARRENDADORA�</b>, as� como en lo referente a ri�as, conatos que pudieran suscitarse durante el desarrollo del evento.

<br><br><b>D�CIMA CUARTA.- DE LOS INTERESES MORATORIOS.-</b> En caso de que <b>�LA ARRENDATARIA�</b> no cubra en tiempo y forma la totalidad del importe del presente contrato, causara un inter�s moratorio del 4.5% mensual sobre el saldo insoluto, el cual empezar� a computarse a partir del siguiente d�a natural a la fecha se�alada para la realizaci�n del evento.

<br><br><b>D�CIMA QUINTA.- RESCISI�N.-</b> Queda expresamente pactado entre las partes, que <b>�LA ARRENDADORA�</b> podr� rescindir el presente contrato de pleno derecho y sin necesidad de declaraci�n judicial si <b>�LA ARRENDATARIA�</b> no cumple con cualquiera de las cl�usulas del presente contrato, as� como el caso:

<br><br>A).- Si destina el inmueble a otro uso se�alado en el presente contrato.

<br><br>B).- Si <b>�LA ARRENDATARIA�</b> no conserva en buen estado el espacio arrendado, as� como tambi�n si altera el orden p�blico.

<br><br>C).- Si se transfiere o en cualquier forma cede en todo o en parte el uso del inmueble arrendado o si traspasa el inmueble o anuncia hacerlo, o bien, si no tiene las autorizaciones y permisos correspondientes de cualquier autoridad Federal, Estatal o Municipal para cumplir con el objeto del presente contrato.

<br><br>D).- Por falta de pago puntual del importe total del arrendamiento y/o prestaci�n de servicios de alimentos y bebidas pactado en este contrato, para cuyo efecto no se podr� entender que el dep�sito sea aplicado al importe que dejo de pagar, ya que el mismo deposito es para garantizar, en su caso, posibles.

<br><br>Da�os y perjuicios que se ocasionen a <b>�LA ARRENDADORA�</b> y no podr� ser aplicado al pago de la renta ni a la prestaci�n de los servicios, salvo convenio escrito entre las partes.

<br><br><b>D�CIMA SEXTA.- JURISDICCI�N.-</b> Ambas partes convienen en que todo lo no previsto en este contrato de arrendamiento y/o prestaci�n de servicios y alimentos y bebidas se regir� por las disposiciones Administrativas y del Condigo Civil para el Estado de Michoac�n. Las partes se someten para la interpretaci�n y cumplimiento de este contrato a la jurisdicci�n y competencia de los tribunales de la ciudad de Morelia, Michoac�n, renunciando a cualquier otro fuero que les pudiera corresponder, en raz�n de sus domicilios presentes o futuros u otras circunstancias.

<br><br><b>D�CIMA S�PTIMA.- DOMICILIOS.-</b> Cualquier aviso, demanda, notificaci�n, solicitud o cualquier otro instrumento que las partes deban darse, de acuerdo con el presente contrato de arrendamiento e inclusive las notificaciones judiciales se sujetara a las siguientes reglas:

<br><br>A).- Si es a <b>�LA ARRENDADORA�</b> en la direcci�n se�alada en la declaraci�n 1.6 del presente contrato.

<br><br>B).- Si son a <b>�LA ARRENDATARIA�</b> en la direcci�n se�alada en la declaraci�n 2.4 del presente contrato.

<br><br><b>D�CIMA OCTAVA. VIGENCIA.-</b> La vigencia del presente contrato ser� por el tiempo que dure el evento que se menciona en la cl�usula PRIMERA del presente convenio.

<br><br>Asimismo, las partes se obligan a dar aviso en forma indubitable a la otra de cualquier cambio de domicilio dentro de los 15 (quince) d�as naturales siguientes a la fecha en que esto ocurra, de no ser as�, cualquier aviso y/o notificaci�n se tendr� como v�lidamente hecha en los domicilios se�alados con anterioridad.
</span>

';


$top_column = '<span style="text-align:justify;"><br><br><b>En el presente contrato no existe dolo, error, mala fe o alg�n otro vicio que pudiera invalidarlo en el cual las partes est�n de acuerdo con el contenido de todas y cada una de las cl�usulas.   <br><br>
Le�do el presente contrato se firma por duplicado, en la ciudad de Morelia, Michoac�n el d�a '.bu (strftime("%A %d")).' del mes de '.bu (strftime("%B")).' del a�o '.bu (strftime("%Y")).'
 </b></span>
<br>
<span style="text-align:center;">
<center>
<br><br>
<b>POR LA ARRENDADORA</b>
<br><br><br><br><br><br><br><br><br>
_______________________________________<br>
<b>C.OSCAR CELIS SILVA</b><br>
DIRECTOR GENERAL DEL<br>
CENTRO DE CONVENCIONES DE MORELIA<br><br><br><br><br><br><br>
</center></span>

';
// create columns content
$left_column = '<span style="text-align:center;">
<center>
_________________________________
<br><b>LIC. GABRIELA LOAIZA NU�EZ</b><br>
SUBDIRECTORA DE MERCADOTECNIA Y
COMERCIALIZACI�N
</center></span>';

$right_column = '<span style="text-align:center;">
<center>
_______________________________
<br><b></b><br>
GERENTE DE VENTAS



</center></span>';


$bot_column = '<span style="text-align:center;">
<center>

<br><br><br><br><br><br><br> <br><br>

</center></span>
';


// set core font
$pdf->SetFont('Carlito', '', 11);

// output the HTML content
$pdf->writeHTML($html, true, 0, true, true);



// get current vertical position
$pdf->AddPage();
$pdf->writeHTML($top_column, true, 0, true, true);
$y = $pdf->getY();
// set color for background
$pdf->SetFillColor(255, 255, 255);

// set color for text
$pdf->SetTextColor(0, 0, 0);


// set color for background
// write the first column
$pdf->writeHTMLCell(90, '', '', $y, $left_column, 0, 0, 1, false, 'J', true);


// write the second column
$pdf->writeHTMLCell(80, '', '', '', $right_column, 0, 1, 1, true, 'J', true);

// reset pointer to the last page

$pdf->writeHTML($bot_column, true, 0, true, true);
$pdf->lastPage();





// ---------------------------------------------------------

//Close and output PDF document
ob_end_clean();
$pdf->Output('Contrato No.-'.$numcontrato.'.pdf', 'I');

