<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Routing\Router;
use Cake\Database\Expression\QueryExpression;
use DateTime;

/**
 * Factures Controller
 *
 * @property \App\Model\Table\FacturesTable $Factures
 *
 * @method \App\Model\Entity\Facture[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FacturesController extends AppController
{
    private $listCategories;

    public function initialize(): void
    {
        $this->loadModel('Categories');
        $this->listCategories = $this->Categories->find('list')->toArray();
    }
    public function csv() {
        $order = $this->request->getQuery('order');
        $columns = ['numero_facture','categorie_id','montant_ttc','adressea','objet','date_facture','relance','reste','montant_ttc_encaissement','date_encaissement','mode_paiement','paye','avoir','remarque'];
        $factures = $this->Factures->find('all')
        ->contain(
            ['Categories' => [
                'fields' => ['libelle']
                ]
            ])
            ->order( [ $columns[$order[0]['column']] => $order[0]['dir']])
            ->offset($this->request->getQuery('start'))
            ->limit($this->request->getQuery('length'));
        $data = [];
        $listeFactures = [];
        foreach ($factures as $f) {
            $listeFactures[] = [
                'id' => $f->id,
                'numero_facture' => $f->numero_facture,
                'categorie_id' => $f->category->libelle,
                'montant_ttc' => $f->montant_ttc,
                'adressea' => $f->adressea,
                'objet' => $f->objet,
                'date_facture' => $f->date_facture ? $f->date_facture->format('d/m/Y') : '',
                'relance' => $f->relance,
                'reste' => $f->reste,
                'montant_ttc_encaissement' => $f->montant_ttc_encaissement,
                'date_encaissement' =>  $f->date_encaissement ? $f->date_encaissement->format('d/m/Y') : '' ,
                'mode_paiement' => $f->mode_paiement,
                'remarque' => $f->remarque,
                'paye' => $f->paye,
                'avoir' => $f->avoir,
                'action' =>'<a href="'. Router::url(['controller' => 'Factures', 'action' => 'edit']).'/'.$f->id.'"/>Modifier<a>',
            ];
        }
        $count =  count($listeFactures);
        $export = [
                'draw' => $this->request->getQuery('draw'),
                'recordsTotal' => $this->Factures->find('all')->count(),
                'recordsFiltered' => $this->Factures->find('all')->count(),
                'data' => $listeFactures

            ];
        echo json_encode($export);
        exit;
        $this->autoRender = false;  
    }
    public function formimport() {
        $facture = $this->Factures->newEmptyEntity();
        $this->set(\compact('facture'));
    }
    public function import()
    {
        if ($this->request->is('post')) {
            $file = $this->request->getData('file');
            $uploadedFile = RESOURCES.$file->getClientFilename();
            if($file->moveTo($uploadedFile)){
                $this->log('Le fichier à été déplacé.');
            }
                $listeFactures = $this->Factures->find('list', [
                    'keyField' => 'id',
                    'valueField' => 'numero_facture']
                )->toArray();
                $row = 1;
                $lignes = [];
                $update = [];
                if (($handle = fopen($uploadedFile, "r")) !== FALSE) {
                    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                        $categorieId = array_search( trim($data[1]),$this->listCategories);

                        $num = count($data);
                        $row++;
                        $ligne = [
                            'numero_facture' => $data[0],
                            'categorie_id' => $categorieId,
                            'montant_ttc' => $this->formatInt($data[2]),
                            'adressea' => utf8_encode($data[3]),
                            'objet' => utf8_encode($data[4]),
                            'date_facture' => \DateTime::createFromFormat('d/m/Y', $data[5]),
                            'relance' => utf8_encode($data[6]),
                            'reste' => $this->formatInt($data[7]),
                            'montant_ttc_encaissement' => $this->formatInt($data[8]),
                            'date_encaissement' => \DateTime::createFromFormat('d/m/Y', $data[9]),
                            'mode_paiement' => utf8_encode($data[10]),
                            'avoir' => $this->getAvoirFromTxt($data[11]),
                            'remarque' => utf8_encode($data[11])
                        ];
                        if(!in_array($ligne['numero_facture'],$listeFactures))
                            $lignes[] = $ligne;
                        else {
                            $ligne['id'] = array_search($ligne['numero_facture'],$listeFactures);
                            $update[] = $ligne;
                        }
                    }
        
                    fclose($handle);
                    $factures = $this->Factures->newEntities($lignes);
                    $result = $this->Factures->saveMany($factures);
                    $entitiesUpdate = $this->Factures->newEntities($update);
                    $result = $this->Factures->saveMany($entitiesUpdate);
                    $expression = new QueryExpression('reste = 0 and remarque = ""');
                    $this->Factures->updateAll([$expression], ['paye' => true]); 
                    $this->set('nombre',count($lignes));
                    $this->set('update',count($entitiesUpdate));
                    $this->set(\compact('factures','entitiesUpdate'));
                }
            }  else {

                return $this->redirect(['action' => 'index']);
            }
        
    }
    private function formatInt($str) {
       if(!empty($str)){
            $replace = str_replace('€','',$str);
            $replace = str_replace(',','.',$replace);
            return is_numeric(trim($replace)) ? trim($replace) : 0 ;
       }
       return 0;
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories'],
        ];
        $factures = $this->paginate($this->Factures);

        $this->set(compact('factures'));
    }

    /**
     * View method
     *
     * @param string|null $id Facture id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $facture = $this->Factures->get($id, [
            'contain' => ['Categories'],
        ]);

        $this->set('facture', $facture);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $facture = $this->Factures->newEmptyEntity();
        if ($this->request->is('post')) {
            $facture = $this->Factures->patchEntity($facture, $this->request->getData());
            if(empty($facture->numero_facture)){

            }
            if ($this->Factures->save($facture)) {
                $this->Flash->success(__('The facture has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The facture could not be saved. Please, try again.'));
        }
        // On génère le prochain numero de facture 
        $facture->numero_facture = $this->autoGenerateFactureNumber();
        $categories = $this->Factures->Categories->find('list', ['limit' => 200]);
        $this->set(compact('facture', 'categories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Facture id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $facture = $this->Factures->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $facture = $this->Factures->patchEntity($facture, $this->request->getData());
            if ($this->Factures->save($facture)) {
                $this->Flash->success(__('The facture has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The facture could not be saved. Please, try again.'));
        }
        $categories = $this->Factures->Categories->find('list', ['limit' => 200]);
        $this->set(compact('facture', 'categories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Facture id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $facture = $this->Factures->get($id);
        if ($this->Factures->delete($facture)) {
            $this->Flash->success(__('The facture has been deleted.'));
        } else {
            $this->Flash->error(__('The facture could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function autoGenerateFactureNumber() {
        $numeroFacture = $this->Factures->find('all',[
            'order' => ['numero_facture' => 'desc'],
            'fields' => ['numero_facture']
        ])->first()->toArray()['numero_facture'];
        $numeroFacture = strval($numeroFacture);
        if(date('m') == substr($numeroFacture,4,2))
            $numeroFacture++;
        else {
            $numeroFacture = str_replace(substr($numeroFacture,4,2),date('m'),$numeroFacture);
            $numeroFacture = str_replace(substr($numeroFacture,6,3),'001',$numeroFacture);

        }
        if(date('Y') !== substr(strval($numeroFacture),0,4))
            $numeroFacture = str_replace(substr($numeroFacture,0,4),date('Y'),$numeroFacture);
              
        return $numeroFacture;
    } 

    public function factureExist($numero = null) {
        if ($this->request->is('post') || $this->request->is('ajax')) {
            echo json_encode([
                'retour' => $this->Factures->exists(['numero_facture' => $numero])
            ]);
            $this->autoRender = false;
        }    
    }

    private function getAvoirFromTxt($string) {
        if(strlen($string) > 0 ) {
            $tab = explode(' ',$string);
            $find = array_filter($tab,function($e){
                if( strpos($e,'€') !== false) {
                    return true;
                } else {
                    return false;
                }
            });
            if( !is_array($find) || count($find) == 1) {
                return trim(str_replace('€','', $find[key($find)]));
            }
        }
        return $string;
    }
}
