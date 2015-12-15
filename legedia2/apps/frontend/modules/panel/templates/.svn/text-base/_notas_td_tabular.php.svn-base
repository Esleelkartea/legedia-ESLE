<td><?php
  echo $nota->getIdNota();
?></td>
<td><?php 
  $texto = truncate_text($nota->getTexto() , 50);
  echo link_to($texto ? $texto : '-', 'notas/edit?id_usuario='.$nota->getIdUsuario()."&id_nota=".$nota->getIdNota());
?></td>
<td><?php 
  echo format_date($nota->getUpdatedAt() , 'f');
?></td>
