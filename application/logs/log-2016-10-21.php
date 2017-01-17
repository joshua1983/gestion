<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-10-21 20:50:16 --> Query error: Unknown column 'a.etiqueta' in 'where clause' - Invalid query: select a.nombres, a.apellidos, a.num_doc, a.email, b.cantidad, a.etiqueta from usuarios a, (select count(1) cantidad, etiqueta from usuarios where usutipo = 3 and a.etiqueta = b.etiqueta group by etiqueta)b  where a.etiqueta = b.etiqueta and usutipo = 4 
