<ul class="nav nav-tabs" style="margin-bottom:20px;">
  <li role="presentation" class="<?php echo (isset($_POST["nav_info"])? "active" : "")?>"><a href="?view=info">Informação Pessoal</a></li>
  <li role="presentation" class="<?php echo (isset($_POST["nav_proj_list"])? "active" : "")?>"><a href="?view=proj_list">Os meus projectos</a></li>
  <li role="presentation" class="<?php echo (isset($_POST["nav_donations"])? "active" : "")?>"><a href="?view=donations">As minhas doações</a></li>
  <li role="presentation" class="<?php echo (isset($_POST["nav_new_proj"])? "active" : "")?>"><a href="?view=new_proj">Novo Projecto</a></li>
</ul>