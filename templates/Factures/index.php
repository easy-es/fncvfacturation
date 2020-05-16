<!-- File: templates/Factures/index.php -->
<?php 
$url =  $this->Url->build([
    "controller" => "Factures",
    "action" => "csv"
]);
?>
<?= $this->Html->script("datatables.js") ?>
<?= $this->Html->script("datetime.js") ?>
<?= $this->element('Factures\filter',['url'=> $url]) ?>

<h1>Factures</h1>
<?= $this->element('Factures\menu') ?>
<table id="table" class="table-responsive table-striped dataTable" style="width:100%">
    <thead class="thead-light">
        <tr>
            <th scope="col">Facture</th>
            <th scope="col">Categorie</th>
            <th scope="col">Montant TTC</th>
            <th scope="col">Adressé A</th>
            <th scope="col">Object</th>
            <th scope="col">date</th>
            <th scope="col">Relance</th>
            <th scope="col" class="w-10">Reste</th>
            <th scope="col">Montant encaissé</th>
            <th scope="col" class="col-sm-1">Date de encaissement</th>
            <th scope="col">Mode de paiement</th>
            <th scope="col">paye</th>
            <th scope="col">avoir</th>
            <th scope="col">Remarque</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    </table>
  </body>
  <script>
    $(document).ready(function() {
        $.fn.dataTable.render.moment( 'YYYY/MM/DD', 'Do MMM YY', 'fr' );
        $('#table').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url":'<?= $url ?>',
                "data": {
                    "categorie": function(){ return $('#categorie-id').val() }
                }

            },
            "columns": [
                { "data": "numero_facture"},
                { "data": "categorie_id" },
                { "data": "montant_ttc",
                    render: function ( data, type, row ) {
                        return  data + '€';
                    }
                 },
                { "data": "adressea" },
                { "data": "objet" },
                { "data": "date_facture"},
                { "data": "relance" },
                { "data": "reste",
                    render: function ( data, type, row ) {
                        return  data + '€';
                    }
                 },
                { "data": "montant_ttc_encaissement",
                    render: function ( data, type, row ) {
                        return  data + '€';
                    }
                 },
                { "data": "date_encaissement" },
                { "data": "mode_paiement" },
                { "data": "paye", 
                    render: function(data, type, row) {
                        return (data !== undefined && data == 1) ? 'oui' : 'non'
                    }
                },
                { "data": "avoir",
                    render: function ( data, type, row ) {
                        if(data != null)
                            return  data + '€';
                        return data;
                    }
                },
                { "data": "remarque"},
                { "data": "action"}
            ],
        "order": [[ 0, "desc" ]],
        "iDisplayLength": 100,
        createdRow: function (row, data, dataIndex) {
            if( data.reste > 0 ) {
                //$(row).addClass('bg-danger');
                //$(row).addClass('text-white');
            } else if (data.reste === 0 || (data.remarque.includes('AVOIR')) ){
                $(row).addClass('bg-success');
                $(row).addClass('text-white');
            }            
        }
        });
        $('#categorie-id').select(function(){
            
        });
    });
  </script>