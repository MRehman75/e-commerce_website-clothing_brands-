<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category as CategoryModel;

class Category extends Component
{
    public $search = '';
    public $selectedChip = 'All';

    public $recentSearches = [];
    public $searchHistory = [];

    public $popularSearches = [];


    protected $listeners = [
        'clearSearch',
    ];


    public function mount()
    {
        $this->recentSearches = session('recent_searches', []);

        $this->searchHistory = session('search_history', []);

        $this->loadPopularSearches();
    }


    public function resetChip()
    {
        $this->selectedChip = 'All';
    }


    public function updatedSearch($value)
    {
        if ($value !== '') {
            $this->selectedChip = 'All';
        }
    }


    public function selectChip($chip)
    {
        $this->selectedChip = $chip;
        $this->search = '';
    }


    public function submitSearch()
    {
        $term = trim($this->search);

        if ($term === '') {
            return;
        }


        // Recent searches (last 5 unique)
        $recent = collect(session('recent_searches', []))
            ->reject(fn ($item) => strcasecmp($item, $term) === 0)
            ->prepend($term)
            ->take(5)
            ->values()
            ->all();


        session([
            'recent_searches' => $recent
        ]);


        $this->recentSearches = $recent;



        // Store all searches for counting
        $history = session('search_history', []);

        $history[] = $term;


        session([
            'search_history' => $history
        ]);


        $this->searchHistory = $history;


        // Refresh popular searches
        $this->loadPopularSearches();
    }



    public function loadPopularSearches()
    {
        $this->popularSearches = collect($this->searchHistory)
            ->filter()
            ->countBy()
            ->sortDesc()
            ->take(5)
            ->keys()
            ->values()
            ->toArray();
    }



    public function selectRecentSearch($term)
    {
        $this->search = $term;
        $this->selectedChip = 'All';

        $this->submitSearch();
    }



    public function searchCategory($term)
    {
        $this->search = $term;
        $this->selectedChip = 'All';

        $this->submitSearch();
    }



    public function clearSearch()
    {
        $this->search = '';
        $this->selectedChip = 'All';
    }



    public function render()
    {
        $categories = CategoryModel::where('status', 1)

            // Category chip filter
            ->when($this->selectedChip !== 'All', function ($query) {
                $query->where('name', 'LIKE', '%' . $this->selectedChip . '%');
            })


            // Search inside products
            ->when($this->search && $this->selectedChip === 'All', function ($query) {

                $query->whereHas('products', function ($q) {

                    $q->where('status', 1)
                      ->where('name', 'LIKE', '%' . $this->search . '%');

                });

            })


            ->withCount('products')


            ->with([
                'products' => function ($query) {

                    $query->where('status', 1);


                    if ($this->search) {

                        $query->where(
                            'name',
                            'LIKE',
                            '%' . $this->search . '%'
                        );

                    }


                    $query->latest();


                    // show 4 only when no search
                    if (!$this->search) {
                        $query->limit(4);
                    }

                }
            ])


            ->orderBy('order')
            ->get();



        return view('livewire.category', [

            'categories' => $categories,

        ])->layout('components.layouts.app');
    }
}