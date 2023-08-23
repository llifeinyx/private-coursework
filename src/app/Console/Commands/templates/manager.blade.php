{!! "<"."?php" !!}

namespace App\{{ $namespace }}Services;

use App\{{ $namespace }}Models\{{ $name }};
use App\Traits\Models\SearchableTrait;
use App\{{ $namespace }}Events\{{ $name }}WasCreated;
use App\{{ $namespace }}Events\{{ $name }}WasUpdated;
use App\{{ $namespace }}Events\{{ $name }}WasDeleted;

class {{ $name }}Manager implements \App\{{ $namespace }}Contracts\{{ $name }}Manager
{
    use SearchableTrait;

    /**
     * @inheritdoc
     */
    public function create(array $data)
    {
        ${{ $var }} = {{ $name }}::create($data);

        event(new {{ $name }}WasCreated(${{ $var }}));

        return ${{ $var }};
    }

    /**
     * @inheritdoc
     */
    public function search(array $params)
    {
        return $this->performSearch({{ $name }}::query(), $params);
    }

    /**
     * @inheritdoc
     */
    public function update({{ $name }} ${{ $var }}, array $data)
    {
        ${{ $var }}->fill($data);
        ${{ $var }}->save();

        event(new {{ $name }}WasUpdated(${{ $var }}));
    }

    /**
     * @inheritdoc
     */
    public function delete({{ $name }} ${{ $var }})
    {
        ${{ $var }}->delete();

        event(new {{ $name }}WasDeleted(${{ $var }}));
    }
}
