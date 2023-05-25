<?php
/*-----------------------------------------------------
* Declaração das rotas do Sistema
*/

# ----- LoginController --------------------------------
$route->get('/', 'LoginController@index');
$route->get('login', 'LoginController@index');
$route->post('login/logar', 'LoginController@logar');
$route->get('login/logout', 'LoginController@logout');

# recuperação de senha do usuário
$route->get('login/senha', 'Login\SenhaController@index');
$route->post('login/senha', 'Login\SenhaController@recuperar');
$route->get('login/senha/recuperacao/{any}', 'Login\SenhaController@recuperacao');
$route->post('login/senha/recuperacao/{any}', 'Login\SenhaController@update');

$route->get('home', 'HomeController@index');

# ----- UsuarioController --------------------------------
$route->get('usuario', 'UsuarioController@index');
$route->post('usuario/save', 'UsuarioController@save');
$route->get('usuario/modalFormulario/{idUsuario?}', 'UsuarioController@modalFormulario');
$route->post('usuario/update', 'UsuarioController@update');
$route->get('usuario/verificaSeEmailExiste/{email}/{idUsuario?}', 'UsuarioController@verificaSeEmailExiste');
$route->get('usuario/desativarUsuario/{idUsuario}', 'UsuarioController@desativarUsuario');
$route->get('usuario/ativarUsuario/{idUsuario}', 'UsuarioController@ativarUsuario');

$route->get('usuario/teste', 'UsuarioController@testeEmail');

# ----- RelatorioController --------------------------------
$route->get('relatorio', 'RelatorioController@index');
$route->get('relatorio/vendasPorPeriodo', 'RelatorioController@vendasPorPeriodo');
$route->post('relatorio/vendasChamadaAjax', 'RelatorioController@vendasChamadaAjax');
$route->get('relatorio/gerarXls/{de}/{ate}/{opcao?}', 'RelatorioController@gerarXls');
$route->get('relatorio/gerarPDF/{de}/{ate}/{opcao?}', 'RelatorioController@gerarPDF');
$route->get('desativarVenda/{idVenda}', 'PdvPadraoController@desativarVenda');
$route->get('relatorio/itensDaVenda/{codigo}', 'RelatorioController@itensDaVendaChamadaAjax');
$route->get('relatorio/gerarPdfDeUmaVenda/{codigo}', 'RelatorioController@gerarPdfDeUmaVenda');


# --------- PacienteController --------------------------------
$route->get('paciente', 'PacienteController@index');
#$route->get('paciente/dashboard', 'PacienteController@dashboard');
$route->get('paciente/modalFormulario/{idPaciente?}', 'PacienteController@modalFormulario');
$route->post('paciente/save', 'PacienteController@save');
$route->post('paciente/update', 'PacienteController@update');
$route->get('paciente/modalVisualizarPaciente/{idPaciente?}', 'PacienteController@modalVisualizarPaciente');
$route->get('paciente/visualizarPaciente/{idPaciente?}', 'PacienteController@visualizarPaciente');
$route->get('paciente/{idPaciente?}/prescricoes', 'PacienteController@modalPrescricaoIndex');
$route->post('paciente/prescricao/save', 'PrescricaoController@save');
$route->post('paciente/prescricao/update', 'PrescricaoController@update');
$route->get('paciente/modalVisualizaPrescricao/{idPrescricao}', 'PacienteController@modalVisualizarPrescricao');
$route->get('paciente/{idPaciente?}/formularioPrescricao', 'PacienteController@modalFormularioPrescricao');
$route->get('paciente/ativarPaciente/{idPaciente}', 'PacienteController@ativarPaciente');

# --------- Leitos --------------------------------
$route->get('leitos', 'LeitoController@index');
$route->get('leitos/dashboard', 'LeitoController@dashboard');
$route->get('leito/modalFormulario/{idLeito?}', 'LeitoController@modalFormulario');
$route->post('leito/save', 'LeitoController@save');
$route->post('leito/update', 'LeitoController@update');

#--------------Prescricoes--------------------------------

$route->get('prescricoes/{idPaciente?}', 'PrescricaoController@index');
$route->get('prescricoes/modalFormularioIndex/{idPaciente?}', 'PrescricaoController@modalFormularioPrescricaoIndex');
$route->get('prescricoes/modalFormulario/{idPaciente?}', 'PrescricaoController@modalFormularioPrescricao');
$route->post('prescricoes/save/{idPaciente?}', 'PrescricaoController@save');
$route->post('prescricoes/update/{idPaciente?}', 'PrescricaoController@update');



# ----- LogController --------------------------------
$route->get('logs', 'LogAcessoController@index');

# ----- EmpresaController --------------------------------
$route->get('empresa', 'EmpresaController@index');
$route->post('empresa/save', 'EmpresaController@save');
$route->post('empresa/update', 'EmpresaController@update');
$route->get('empresa/modalFormulario/{idEmpresa?}', 'EmpresaController@modalFormulario');
$route->get('empresa/verificaSeEmailExiste/{email}/{idEmpresa?}', 'EmpresaController@verificaSeEmailExiste');

# ----- HospitalController --------------------------------
$route->get('hospital', 'HospitalController@index');
$route->post('hospital/save', 'HospitalController@save');
$route->post('hospital/update', 'HospitalController@update');
$route->get('hospital/modalFormulario/{idHospital?}', 'HospitalController@modalFormulario');
$route->get('hospital/verificaSeEmailExiste/{email}/{idHospital?}', 'HospitalController@verificaSeEmailExiste');



# ----- # ----- CadastroExternoController --------------------------------
$route->get('criarConta/index', 'CadastroExternoController@index');

# Router run
$route->run();
