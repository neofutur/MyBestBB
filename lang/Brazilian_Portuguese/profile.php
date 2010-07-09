<?php

// Language definitions used in profile.php
$lang_profile = array(

// Navigation and sections
'Profile menu'				=>	'Menu de perfil',
'Section essentials'		=>	'Geral',
'Section personal'			=>	'Pessoal',
'Section messaging'			=>	'Mensagens',
'Section personality'		=>	'Personalidade',
'Section display'			=>	'Exibição',
'Section privacy'			=>	'Privacidade',
'Section admin'				=>	'Administração',

// Miscellaneous
'Username and pass legend'	=>	'Entre com o seu nome de usuário e senha',
'Personal details legend'	=>	'Entre com os seus dados pessoais',
'Contact details legend'	=>	'Entre com seus dados de mensagens',
'Options display'			=>	'Configure suas opções de exibição',
'Options post'				=>	'Configure suas opções de visualização de posts',
'User activity'				=>	'Atividade do usuário',
'Paginate info'				=>	'Entre com o número de tópicos e posts que você deseja exibir por página.',

// Password stuff
'Pass key bad'				=>	'A chave de ativação de senha especificada é inválida ou já expirou. Por favor, solicite novamente uma nova senha. Se isso não funcionar, entre em contato com o administrador em',
'Pass updated'				=>	'Sua senha foi alterada. Agora você pode se logar com a nova senha.',
'Pass updated redirect'		=>	'Senha alterada. Redirecionando &hellip;',
'Wrong pass'				=>	'Senha antiga inválida.',
'Change pass'				=>	'Alterar senha',
'Change pass legend'		=>	'Digite e confirme sua nova senha',
'Old pass'					=>	'Senha antiga',
'New pass'					=>	'Nova senha',
'Confirm new pass'			=>	'Confirme a nova senha',

// E-mail stuff
'E-mail key bad'			=>	'A chave de ativação de email especificada é inválida ou já expirou. Por favor, solicite novamente a alteração de email. Se isso não funcionar, entre em contato com o administrador em',
'E-mail updated'			=>	'Seu endereço de email foi alterado.',
'Activate e-mail sent'		=>	'Foi enviado uma mensagem para o email especificado com as instruções de como ativar o novo endereço de email. Se a mensagem não chegar, você pode contactar o administrador do fórum em',
'E-mail legend'				=>	'Entre com o seu novo endereço de email',
'E-mail instructions'		=>	'Uma mensagem será enviada para o seu novo endereço de email com um link para ativação. Você deve clicar no link que receber para ativar o novo endereço de email.',
'Change e-mail'				=>	'Alterar endereço de email',
'New e-mail'				=>	'Novo email',

// Avatar upload stuff
'Avatars disabled'			=>	'O administrador desativou o uso de avatars.',
'Too large ini'				=>	'O arquivo selecionado é muito grande e não pode ser enviado. O servidor não permitiu o envio.',
'Partial upload'			=>	'O arquivo selecionado foi enviar parcialmente. Por favor, tente novamente.',
'No tmp directory'			=>	'O PHP não conseguiu salvar o arquivo enviado em um local temporário.',
'No file'					=>	'Você não selecionou um arquivo para enviar.',
'Bad type'					=>	'O arquivo que você tentou enviar é de um tipo não permitido. Os tipos permitidos são gif, jpeg e png.',
'Too wide or high'			=>	'O arquivo que você tentou enviar tem dimensões maiores do que as permitidas',
'Too large'					=>	'O arquivo que você tentou enviar é maior do que o permitido',
'pixels'					=>	'pixels',
'bytes'						=>	'bytes',
'Move failed'				=>	'O servidor não foi capaz de salvar o arquivo enviado. Por favor, entre em contato com o administrador do fórum em',
'Unknown failure'			=>	'Um erro desconhecido ocorreu. Por favor, tente novamente.',
'Avatar upload redirect'	=>	'Avatar enviado. Redirecionando &hellip;',
'Avatar deleted redirect'	=>	'Avatar deleted. Redirecionando &hellip;',
'Avatar desc'				=>	'Um avatar é uma imagem pequena que será exibida sob o seu nome de usuário nos seus posts. A imagem não pode ser maior que',
'Upload avatar'				=>	'Enviar avatar',
'Upload avatar legend'		=>	'Entre com um arquivo de avatar para enviar',
'Delete avatar'				=>	'Excluir avatar',	// only for admins
'File'						=>	'Arquivo',
'Upload'					=>	'Enviar',	// submit button

// Form validation stuff
'Dupe username'				=>	'Alguém já se cadastrou com esse nome de usuário. Por favor, volte e tente um outro nome de usuário.',
'Forbidden title'			=>	'O título digitado contém uma palavra proibida. Você deve escolher um título diferente.',
'Profile redirect'			=>	'Perfil atualizado. Redirecionando &hellip;',

// Profile display stuff
'Not activated'				=>	'Esta conta de usuário ainda não foi ativada. A conta será ativada quando o(a) usuário(a) que a criou se logar pela primeira vez.',
'Unknown'					=>	'(Desconhecido)',	// This is displayed when a user hasn't filled out profile field (e.g. Location)
'Private'					=>	'(Privado)',	// This is displayed when a user does not want to receive e-mails
'No avatar'					=>	'(Sem avatar)',
'Show posts'				=>	'Exibir todos os posts',
'Realname'					=>	'Nome verdadeiro',
'Location'					=>	'Localização',
'Website'					=>	'Website',
'Jabber'					=>	'Jabber',
'ICQ'						=>	'ICQ',
'MSN'						=>	'MSN Messenger',
'AOL IM'					=>	'AOL IM',
'Yahoo'						=>	'Yahoo! Messenger',
'Avatar'					=>	'Avatar',
'Signature'					=>	'Assinatura',
'Sig max length'			=>	'Comprimento máximo',
'Sig max lines'				=>	'Número máximo de linhas',
'Avatar legend'				=>	'Configure suas opções de exibição de avatar',
'Avatar info'				=>	'Um avatar é uma imagem pequena que será exibida em todos os seus posts. Você pode enviar um avatar clicando no link abaixo. O checkbox \'Usar avatar\' deve estar marcado para que a imagem seja exibida nos seus posts.',
'Change avatar'				=>	'Alterar avatar',
'Use avatar'				=>	'Usar avatar.',
'Signature legend'			=>	'Compor assinatura',
'Signature info'			=>	'Uma assinatura é um pequeno texto que é anexado aos seus posts.  Nela você pode escrever o que quiser, como sua frase favorita ou o seu signo. Você decide! Você também pode usar BBCode na assinatura, caso o BBCode esteja ativado no fórum. Você pode ver uma lista do que está ativado / habilidado abaixo, sempre que for alterar sua assinatura.',
'Sig preview'				=>	'Pré-visualização da assinatura atual:',
'No sig'					=>	'Não existe uma assinatura no seu perfil.',
'Topics per page'			=>	'Tópicos',
'Topics per page info'		=>	'Esta opção indica quantos tópicos são exibidos por página quando você navega pelo fórum. Se você não sabe o que usar, pode deixar o campo em branco para que o valor padrão seja usado.',
'Posts per page'			=>	'Posts',
'Posts per page info'		=>	'Esta opção indica quantos posts são exibidos por página quando você estiver visualizando um tópico Se você não sabe o que usar, pode deixar o campo em branco para que o valor padrão seja usado.',
'Leave blank'				=>	'Deixe em branco para usar o valor padrão do fórum.',
'Notify full'				=>	'Incluir posts nos emails de inscrição.',
'Notify full info'			=>	'Com esta opção habilitada, uma versão somente-texto do novo post será incluída nas notificações de novo post enviadas para o seu email.',
'Show smilies'				=>	'Exibir smilies como imagens',
'Show smilies info'			=>	'Se você habilitar esta opção, pequenas imagens serão exibidas ao invés dos smilies de texto.',
'Show images'				=>	'Exibir imagens nos posts.',
'Show images info'			=>	'Desabilite esta opção se você não deseja ver imagens nos posts (isto é, imagens exibidas com a tag [img]).',
'Show images sigs'			=>	'Exibir imagens nas assinaturas de usuários.',
'Show images sigs info'		=>	'Desabilite esta opção se você não deseja ver imagens nas assinaturas de usuários (isto é, imagens exibidas com a tag [img])..',
'Show avatars'				=>	'Exibir avatars de usuários nos posts.',
'Show avatars info'			=>	'Esta opção indica se os avatars dos usuários devem ser exibidos nos posts ou não.',
'Show sigs'					=>	'Exibir assinaturas de usuários.',
'Show sigs info'			=>	'Habilite caso deseje ver as assinaturas de usuários.',
'Style legend'				=>	'Selecione o estilo de sua preferência',
'Style info'				=>	'Se desejar, você pode usar um estilo visual diferente neste fórum.',
'Admin note'				=>	'Nota do Administrador',
'Pagination legend'			=>	'Entre com suas opções de paginação',
'Post display legend'		=>	'Configure suas opções para visualização de posts',
'Post display info'			=>	'Se a sua conexão internet é lenta, pode desabilitar estas opções (principalmente a exibição de imagens em posts e assinaturas) para tornar o carregamento das páginas mais rápido.',
'Instructions'				=>	'Quando atualizar o seu perfil, será redirecionado de volta para esta página.',

// Administration stuff
'Group membership legend'	=>	'Escolha o grupo de usuários',
'Save'						=>	'Salvar',
'Set mods legend'			=>	'Configure o acesso de moderadores',
'Moderator in'				=>	'Moderador em',
'Moderator in info'			=>	'Escolha em quais fóruns este usuário será moderador. Aviso: Esta opção só se aplica aos moderadores. Administradores sempre têm permissão total em todos os fóruns.',
'Update forums'				=>	'Atualizar fóruns',
'Delete ban legend'			=>	'Excluir (somente administradores) ou banir usuários',
'Delete user'				=>	'Excluir usuário',
'Ban user'					=>	'Banir usuário',
'Confirm delete legend'		=>	'Importante: leia antes de excluir o usuário',
'Confirm delete user'		=>	'Confirme a exclusão do usuário',
'Confirmation info'			=>	'Por favor, confirme que você deseja excluir o(a) usuário(a)',	// the username will be appended to this string
'Delete warning'			=>	'Atenção! Usuários e/ou posts excluídos não podem ser restaurados. Se você optar por não excluir os posts criados por este usuário, depois os posts só poderão ser excluídos manualmente.',
'Delete posts'				=>	'Excluir qualquer tópico ou post criado por este usuário.',
'Delete'					=>	'Excluir',		// submit button (confirm user delete)
'User delete redirect'		=>	'Usuário excluído. Redirecionando &hellip;',
'Group membership redirect'	=>	'Associação do grupo gravada. Redirecionando &hellip;',
'Update forums redirect'	=>	'As permissões do moderador do fórum foram atualizadas. Redirecionando &hellip;',
'Ban redirect'				=>	'Redirecionando &hellip;'

);
