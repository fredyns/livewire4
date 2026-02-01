# wire:stream

source: https://livewire.laravel.com/docs/4.x/wire-streamLivewire allows you to stream content to a web page before a request is complete via the `wire:stream` API.This is an extremely useful feature for things like AI chat-bots which stream responses as they are generated.Livewire currently does not support using `wire:stream` with Laravel Octane.#

# Basic usageBelow is a simple `CountDown` component that displays a count-down from `3` to `0` when a button is pressed:

```

phpuse Livewire\Component;class CountDown extends Component{    public $start = 3;    public function begin()    {        while ($this->start >= 0) {            // Stream the current count to the browser...            $this->stream(                to: 'count',                content: $this->start,                replace: true,            );            // Pause for 1 second between numbers...            sleep(1);            // Decrement the counter...            $this->start = $this->start
- 1;        };    }    public function render()    {        return <<<'HTML'            <div>                <button wire:click="begin">Start count-down</button>                <h1>Count: <span wire:stream="count">{{ $start }}</span></h1>            </div>        HTML;    }}

```

From the user's perspective:- "Count: 3" is shown- They press "Start count-down"- Every second, the count is updated until "Count: 0" is shownAll of the above happens while a single network request is out to the server.#

# Streaming chat-bot responsesA common use-case for `wire:stream` is streaming chat-bot responses as they are received from an API that supports streamed responses.Below is an example of using `wire:stream` to accomplish a ChatGPT-like interface:

```

phpuse Livewire\Component;class ChatBot extends Component{    public $prompt = '';    public $question = '';    public $answer = '';    function submitPrompt()    {        $this->question = $this->prompt;        $this->prompt = '';        $this->js('$wire.ask()');    }    function ask()    {        $this->answer = OpenAI::ask($this->question, function ($partial) {            $this->stream(to: 'answer', content: $partial);        });    }    public function render()    {        return <<<'HTML'            <div>                <section>                    <div>ChatBot</div>                    @if ($question)                        <article>                            <hgroup>                                <h3>User</h3>                                <p>{{ $question }}</p>                            </hgroup>                            <hgroup>                                <h3>ChatBot</h3>                                <p wire:stream="answer">{{ $answer }}</p>                            </hgroup>                        </article>                    @endif                </section>                <form wire:submit="submitPrompt">                    <input wire:model="prompt" type="text" placeholder="Send a message" autofocus>                </form>            </div>        HTML;    }}

```

#

# Replace vs. appendWhen streaming content to an element using `$this->stream()`, you can tell Livewire to either replace the contents of the target element with the streamed contents or append them to the existing contents.Replacing or appending can both be desirable depending on the scenario.You can configure either by passing the `replace:` parameter to `$this->stream`:

```

php// Append contents...$this->stream(to: 'target', content: '...');// Replace contents...$this->stream(to: 'target', content: '...', replace: true);

```

Append/replace can also be specified at the target element level by appending or removing the `.replace` modifier:

```

blade<!-- Append contents... --><div wire:stream="target"></div><!-- Replace contents... --><div wire:stream.replace="target"></div>

```

#

# Reference

```

textwire:stream="name"

```

##

# Modifiers- `.replace`
