<?phpnamespace App\Services;use Carbon\Carbon;class PostService extends BaseService{    /**     * @return \Illuminate\Support\Collection     */    public function getPost()    {        $posts = json_decode(file_get_contents(storage_path() . "/data/posts.json"), true);        $authors = json_decode(file_get_contents(storage_path() . "/data/authors.json"), true);        return collect($posts)->map(function ($item, $key) use ($authors) {            $item['author'] = collect($authors)->firstWhere('id', $item['author_id']);            $item['created_at_formated'] = Carbon::parse($item['created_at'])->format('l, F d, Y, H:m');            return $item;        });    }}