{!! "<"."?php" !!}

namespace App\{{ $namespace }}Contracts;

use App\{{ $namespace }}Models\{{ $name }};

interface {{ $name }}Manager
{
    /**
     * Create a {{ $var }} from the given input
     * 
     * @param array $data
     * @return {{ $name }}
     */
    public function create(array $data);

    /**
     * Search {{ $vars }}
     * 
     * @param array $params
     * @return \Illuminate\Pagination\Paginator
     */
    public function search(array $params);

    /**
     * Update the {{ $var }} within the given input
     * 
     * @param {{ $name }} ${{ $var }}
     * @param array $data
     */
    public function update({{ $name }} ${{ $var }}, array $data);

    /**
     * Delete the given {{ $var }}
     * 
     * @param {{ $name }} ${{ $var }}
     */
    public function delete({{ $name }} ${{ $var }});
}