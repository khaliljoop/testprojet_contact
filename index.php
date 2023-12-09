<!DOCTYPE html>
<html>
<head>
    <title>Contact Management</title>
    <link rel="stylesheet" type="text/css" href="contact.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
</head>
<body>
    <div class="container">
        <h1>Contact Management</h1>
        <?php 
       require_once 'class.contact.php';
       $contact=new Contact();
       $contacts=$contact->getContacts();
        ?>
        <button id="add-contact">Add Contact</button>
        <div class="contact-form hidden" id="contact-popup" >
            <form id="contact-form" action="index.php" method="post" >
                <label for="prenom">Prenom:</label>
                <input type="text" id="prenom" name="prenom" >
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom">
                <label for="telephone">Telephone:</label>
                <input type="text" id="telephone" name="telephone">
                <label for="id_categorie">Category:</label>
                <select id="id_categorie" name="id_categorie">
                    <option value="">Select Category</option>
                    <?php
                    $categories=$contact->getCategories();
                    foreach($categories as $category){
                        echo "<option value='".$category['id_categorie']."'>".$category['libelle'];
                    }
                    ?>
                <input type="submit" id="submit"value="Submit" name="submit"/>
            </form>
            </div>
        <table id="contact-table">
            <thead>
                <tr>
                    <th>prenom</th>
                    <th>nom</th>
                    <th>telephone</th>
                    <th>Categorie</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($contacts as $_contact):
                $cat=$contact->getCategorById($_contact['id_categorie']);
                ?>
                <tr>
                    <td><?=$_contact['prenom']?></td>
                    <td><?=$_contact['nom']?></td>
                    <td><?=$_contact['telephone']?></td>
                    <td><?=$cat['libelle']?></td>
                    <td>
                        <button class="edit-button"><span class="id_hidden" ><?=$_contact['id']?></span>Edit</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <?php 
        if (isset($_POST['submit'])) {
            if (isset($_POST['prenom']) && isset($_POST['nom'])) {
                $contact=new Contact();
               $resultat=$contact->addContact($_POST['prenom'], $_POST['nom'],$_POST['telephone'], $_POST['id_categorie']);
            }
        }
    ?>
    <script src="contact.js"></script>
</body>

</html>