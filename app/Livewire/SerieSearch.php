<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use TallStackUi\Traits\Interactions;

class SerieSearch extends Component
{
    use Interactions;
    // Propriedades públicas
    public $searchQuery = '';
    public $series = [];
    public $selectSeries;
    public $findSeriesPropries = true;
    public $serieName;
    public $serieDescription;
    public $serieImage;
    public $serieYear;
    public $serieData;
    public $category;


    /**
     * Metodo usado para buscar o filme pelo nome.
     *  @return void
     */
    public function searchSeries(): void
    {
        $query = $this->searchQuery;
        $response = Http::get("http://4cdn.cc:80/painelvods992N4x/?api_key=9805B284800D5DF9B7AD1CD6CB80117E&action=get_series_list&search%5Bvalue%5D={$query}");

        if ($response->successful()) {
            $data = $response->json();
            $this->series = $data['data'];
            $this->selectSeries = '';
            if (empty($this->series)) {
                $this->selectSeries = '';
                $this->toast()->error('Nenhum série encontrada!');
            }
        }
    }

    public function searchSeriesByID()
    {
        $query = $this->selectSeries;
        $response = Http::get("http://4cdn.cc:80/painelvods992N4x/?api_key=9805B284800D5DF9B7AD1CD6CB80117E&action=get_series&id={$query}");
        if ($response->successful()) {
            $data = $response->json();
            if (!empty($data)) {

                $serieId = $data["data"]["tmdb_id"];
                $this->serieDescription = $data["data"]["plot"];

                $api_key = '78fe940c572dbe0ca18c4cf5c59db941';
                $url = "https://api.themoviedb.org/3/tv/{$serieId}?language=pt-BR&api_key={$api_key}";
                $response = Http::get($url);

                if ($response->successful()) {
                    $this->serieData = $response->json();
                    $this->serieImage = $this->serieData["poster_path"];
                    $this->findSeriesPropries = true;
                    $this->searchQuery = '';
                    $this->toast()->success('Série encontrada!');
                } else {
                    $this->toast()->error('Algumas informações da Série não estão disponíveis!');
                    $this->findSeriesPropries = false;
                    $this->searchQuery = '';
                }
            } else {
                $this->serieImage = 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png';
                $this->serieDescription = 'Filme sem descrição';
                $this->toast()->error('Algumas informações da Série não estão disponíveis!');
                $this->findSeriesPropries = false;
                $this->searchQuery = '';
            }

            $this->serieYear = $data["data"]["year"];
            $this->serieName = $data["data"]["title"];
            $idquery = str_replace(['[', ']'], '', $data["data"]["category_id"]);
            $getCateogory = Http::get("http://4cdn.cc:80/painelvods992N4x/?api_key=9805B284800D5DF9B7AD1CD6CB80117E&action=get_category&id={$idquery}");
            $dataCategory = $getCateogory->json();
            $this->category = $dataCategory["data"]["category_name"];
        }
    }
    public function render()
    {
        return view('livewire.serie-search');
    }
}