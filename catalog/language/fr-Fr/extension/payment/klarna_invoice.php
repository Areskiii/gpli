<?php

// Text

$_['text_title']				='Facture Klarna - Payez dans les 14 jours';
$_['text_terms_fee']			='  <span id="klarna_invoice_toc">  </span> (+%s) <script type="text/javascript"> Var terms = new Klarna. termes. Facture ({el: \\ klarna_invoice_toc \\, eid: \\ %s \\, pays: \\ %s \\, charge: %s}).  </script> ';
$_['text_terms_no_fee']			='  <span id="klarna_invoice_toc">  </span>  <script type="text/javascript"> Var terms = new Klarna. termes. Facture ({el: \\ klarna_invoice_toc \\, eid: \\ %s \\, pays: \\ %s \\}).  </script> ';
$_['text_additional']			='La facture de Klarna nécessite des informations supplémentaires avant de pouvoir traiter votre commande.';
$_['text_male']					='Mâle';
$_['text_female']				='Femelle';
$_['text_year']					='An';
$_['text_month']				='Mois';
$_['text_day']					='journée';
$_['text_comment']				='Identification de la facture de Klarna: %s.\. %s/%s:%. 4f. ';


// Entry

$_['entry_gender']				='Le genre';
$_['entry_pno']					='Numéro personnel';
$_['entry_dob']					='Date de naissance';
$_['entry_phone_no']			='Numéro de téléphone';
$_['entry_street']				='rue';
$_['entry_house_no']			='Numéro de maison.';
$_['entry_house_ext']			='Maison Ext.';
$_['entry_company']				='Numéro d`entreprise';


// Help

$_['help_pno']					='Entrez votre numéro de sécurité sociale ici.';
$_['help_phone_no']				='S`il vous plait, entrez votre numéro de téléphone.';
$_['help_street']				='Veuillez noter que la livraison ne peut avoir lieu qu`à l`adresse enregistrée lors du paiement avec Klarna.';
$_['help_house_no']				='Entrez votre numéro de maison.';
$_['help_house_ext']			='Veuillez envoyer votre poste de maison ici. E. g. A, B, C, Rouge, Bleu ect.';
$_['help_company']				='Entrez le numéro d`inscription de votre société';


// Error

$_['error_deu_terms']			='Vous devez accepter la politique de confidentialité de Klarna (Datenschutz)';
$_['error_address_match']		='Les adresses de facturation et d`expédition doivent correspondre si vous souhaitez utiliser la facture de Klarna';
$_['error_network']				='Une erreur s`est produite lors de la connexion à Klarna. Veuillez réessayer plus tard.';