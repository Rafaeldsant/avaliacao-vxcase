<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Eloquent\ProductRepository;

class ProductCreate extends Command
{

    private $product;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for create new product';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ProductRepositoryInterface $product)
    {
        $this->product = $product;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->line('Bem vindo ao cadastro de produtos da VX CASE');
        $this->line('Para continuar o cadastro do item: '.$this->argument('name').', por favor, informe:');

        $questions = [
            'Ref. Produto (Somente números)',
            'Preço',
            'Prazo de Entrega (Dias)'
        ];

        $answers = [];

        $answers['name'] = $this->argument('name');

        foreach($questions as $key => $question){

            $answer = $this->ask($question);

            if(!isset($answer)) {
                $this->error("Todos os campos são obrigatórios. Operação cancelada");
                return;
            }

            if($key == 0) { //reference

                if(!is_numeric($answer) || strlen($answer) > 5) {
                    $this->error("Código de referência inválido. Operação cancelada");
                    return;
                }

                $answers['reference'] = 'VX-'.$answer;

            } else if($key == 1) { //price

                $answer = str_replace(',', '.', $answer);

                if(!is_numeric($answer)) {
                    $this->error("Insira um valor válido. Operação cancelada");
                    return;
                }

                $answers['price'] = number_format($answer,'2','.','');

            } else { //delivery_days

                if(!is_numeric($answer)) {
                    $this->error("Insira um prazo de entrega válido. Operação cancelada");
                    return;
                }

                $answers['delivery_days'] = $answer;

            }

        }

        $this->product->create($answers);

        $this->info("Produto Cadastrado com sucesso!");

        $this->line('Produto: '.$answers['name']);

        $args = array();
        $args[0] = 'reference';
        $args[1] = 'price';
        $args[2] = 'delivery_days';

        for($i = 0;$i <= (count($questions) -1 );$i++){
            $this->line(($questions[$i]).': '. $answers[$args[$i]]);
        }

    }
}
