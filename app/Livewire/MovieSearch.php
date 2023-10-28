<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use TallStackUi\Traits\Interactions;


/**
 * Classe MovieSearch
 *
 * Esta classe é responsável por pesquisar filmes em uma API e recuperar informações do TMDB.
 */
class MovieSearch extends Component
{
    use Interactions;
    // Propriedades públicas
    public $searchQuery = '';
    public $findMoviesPropries = true;
    public $streamName;
    public $movieData;
    public $category;
    public $year;
    public $streamImage;
    public $streamDescription;
    public $movies = [];
    public $selectedMovie;



    /**
     * Metodo usado para buscar o filme pelo nome.
     *  @return void
     */
    public function searchMovies(): void
    {
        $query = $this->searchQuery;
        $response = Http::get("http://4cdn.cc:80/painelvods992N4x/?api_key=9805B284800D5DF9B7AD1CD6CB80117E&action=get_movies&search%5Bvalue%5D={$query}");

        if ($response->successful()) {
            $data = $response->json();
            $this->movies = $data['data'];
            if (empty($this->movies)) {
                $this->selectedMovie = '';
                $this->toast()->error('Nenhum filme encontrado!');
            }
        }
    }

    public function searchMoviesByID()
    {
        $query = $this->selectedMovie;
        $response = Http::get("http://4cdn.cc:80/painelvods992N4x/?api_key=9805B284800D5DF9B7AD1CD6CB80117E&action=get_movie&id={$query}");

        if ($response->successful()) {
            $data = $response->json();
            $movieProperties = json_decode($data["data"]["movie_properties"], true);
            if (!empty($movieProperties)) {

                $description = $movieProperties["description"];
                $movieId = $movieProperties["tmdb_id"];
                $this->streamDescription = $description;

                $api_key = '78fe940c572dbe0ca18c4cf5c59db941';
                $url = "https://api.themoviedb.org/3/movie/{$movieId}?language=pt-BR&api_key={$api_key}";
                $response = Http::get($url);

                if ($response->successful()) {
                    $this->movieData = $response->json();
                    $this->streamImage = $this->movieData["poster_path"];
                    $this->findMoviesPropries = true;
                    $this->toast()->success('Filme encontrado!');
                } else {
                    $this->movieData = ['error' => 'Falha ao buscar detalhes do filme.'];
                    $this->toast()->error('Algumas informações do filme não estão disponíveis!');
                }
            } else {
                $this->streamImage = 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png';
                $this->streamDescription = 'Filme sem descrição';
                $this->toast()->error('Algumas informações do filme não estão disponíveis!');
                $this->findMoviesPropries = false;
            }

            $this->year = $data["data"]["year"];
            $this->streamName = $data["data"]["stream_display_name"];
            $idquery = str_replace(['[', ']'], '', $data["data"]["category_id"]);
            $getCateogory = Http::get("http://4cdn.cc:80/painelvods992N4x/?api_key=9805B284800D5DF9B7AD1CD6CB80117E&action=get_category&id={$idquery}");
            $dataCategory = $getCateogory->json();
            $this->category = $dataCategory["data"]["category_name"];
        }
    }


    public function render()
    {
        return view('livewire.movie-search');
    }
}