<?php

namespace Hasnayeen\GlowChart;

use Closure;
use Error;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Conditionable;

/**
 * @method Trend between($start, $end)
 * @method Trend perMinute()
 * @method Trend perHour()
 * @method Trend perDay()
 * @method Trend perMonth()
 * @method Trend perYear()
 * @method Collection count(string $column = '*')
 * @method Collection sum(string $column)
 * @method Collection average(string $column)
 * @method Collection min(string $column)
 * @method Collection max(string $column)
 */
class Series
{
    use Conditionable;

    private function __construct(
        public ?string $name,
        public array | Collection $data,
        public ?Model $model = null,
        public ?Trend $trend = null,
    ) {
    }

    public static function make(string $name = null, array | Collection $data = []): self
    {
        return new static($name, $data);
    }

    public function name(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function data(array | Collection $data = []): self
    {
        if (empty($data)) {
            $this->data = [];

            return $this;
        }

        if ($data instanceof Collection) {
            $data = $data->toArray();
        }

        if (is_array(head($data))) {
            $this->data = $data;

            return $this;
        }

        $this->data = [
            [
                'name' => $this->name,
                'data' => $data,
            ],
        ];

        return $this;
    }

    public function model(string | Model $model): self
    {
        if (is_string($model)) {
            $this->model = new $model();

            return $this;
        }

        $this->model = $model;

        return $this;
    }

    public function trend(Closure $modifyQueryUsing = null): self
    {
        if (is_null($modifyQueryUsing)) {
            $this->trend = Trend::query($this->model->query());

            return $this;
        }

        $query = $modifyQueryUsing($this->model->query());
        $this->trend = Trend::query($query);

        return $this;
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function __call(string $name, array $arguments): self
    {
        if (method_exists($this->trend, $name)) {
            $result = $this->trend->$name(...$arguments);

            if ($result instanceof Collection) {
                return $this->data($result->map(fn (TrendValue $value) => $value->aggregate));
            }

            $this->trend = $result;

            return $this;
        }

        throw new Error('Call to undefined method ' . __CLASS__ . "::{$name}()");
    }
}
