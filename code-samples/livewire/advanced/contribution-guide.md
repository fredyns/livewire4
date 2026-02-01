# Contribution Guide

source: https://livewire.laravel.com/docs/4.x/contribution-guideThis guide explains how to contribute to Livewire by submitting new features, fixing failing tests, or resolving bugs.#

# Setting up Livewire and Alpine locallyThe easiest way to contribute is to set up the Livewire and Alpine repositories locally.

##

# Forking and cloning the repositoriesYou can fork/clone using GitHub CLI (or manually).Livewire setup:

```

bash

# Fork and clone Livewiregh repo fork livewire/livewire --default-branch-only --clone=true --remote=false -- livewire

# Switch the working directory to livewirecd livewire

# Install all composer dependenciescomposer install

# Ensure Dusk is correctly configuredvendor/bin/dusk-updater detect --no-interaction

```

Alpine setup:

```

bash

# Fork and clone Alpinegh repo fork alpinejs/alpine --default-branch-only --clone=true --remote=false -- alpine

# Switch the working directory to alpinecd alpine

# Install all npm dependenciesnpm install

# Build all Alpine packagesnpm run build

# Link all Alpine packages locallycd packages/alpinejs && npm link && cd ../../cd packages/anchor && npm link && cd ../../cd packages/collapse && npm link && cd ../../cd packages/csp && npm link && cd ../../cd packages/docs && npm link && cd ../../cd packages/focus && npm link && cd ../../cd packages/history && npm link && cd ../../cd packages/intersect && npm link && cd ../../cd packages/mask && npm link && cd ../../cd packages/morph && npm link && cd ../../cd packages/navigate && npm link && cd ../../cd packages/persist && npm link && cd ../../cd packages/sort && npm link && cd ../../cd packages/ui && npm link && cd ../../

# Switch the working directory back to livewirecd ../livewire

# Link all packagesnpm link alpinejs @alpinejs/anchor @alpinejs/collapse @alpinejs/csp @alpinejs/docs @alpinejs/focus @alpinejs/history @alpinejs/intersect @alpinejs/mask @alpinejs/morph @alpinejs/navigate @alpinejs/persist @alpinejs/sort @alpinejs/ui

# Build Livewirenpm run build

```

#

# Contributing a failing testIf you’re encountering a bug and aren’t sure how to solve it, contributing a failing test is often the easiest way to help.

##

# 1. Determine where to add your testLivewire’s core is divided into feature folders, for example:

```

textsrc/Features/SupportAccessingParentsrc/Features/SupportAttributessrc/Features/SupportAutoInjectedAssetssrc/Features/SupportBladeAttributessrc/Features/SupportChecksumErrorDebuggingsrc/Features/SupportComputedsrc/Features/SupportConsoleCommandssrc/Features/SupportDataBinding//...

```

##

# 2. Determine the type of testLivewire uses:1. Unit tests (PHP)2. Browser tests (Dusk/JS behaviors)Unit tests go in `UnitTest.php`, browser tests in `BrowserTest.php`.Unit test example:

```

phpuse Tests\TestCase;class UnitTest extends TestCase{    public function test_livewire_can_run_action(): void    {        // ...    }}

```

Browser test example:

```

phpuse Tests\BrowserTestCase;class BrowserTest extends BrowserTestCase{    public function test_livewire_can_run_action()    {        // ...    }}

```

##

# 3. Running the tests

```

bashvendor/bin/phpunit --filter "test_can_make_method_a_computed"vendor/bin/phpunit

```

Browser tests run headed by default. To run headless, create `.env` and set:

```

textDUSK_HEADLESS_DISABLED=false

```

##

# 4. Preparing your pull request branchAvoid using `main`.

```

bashgit checkout -b my-feature

```

Then commit changes:

```

bashgit add .git commit -m "Add my feature"

```

Push:

```

bashgit push origin my-feature

```

##

# 5. Submitting your pull requestOpen your fork on GitHub (e.g. `https://github.com/<your-username>/livewire`) and use “Compare & pull request”.The PR description includes a template. Fill it out thoroughly.Example template content:

```

textReview the contribution guide first at: https://livewire.laravel.com/docs/contribution-guide1️⃣ Is this something that is wanted/needed? Did you create a discussion about it first?Yes, you can find the discussion here: https://github.com/livewire/livewire/discussions/9999992️⃣ Did you create a branch for your fix/feature? (Main branch PR's will be closed)Yes, the branch is named `my-feature`3️⃣ Does it contain multiple, unrelated changes? Please separate the PRs out.No, the changes are only related to my feature.4️⃣ Does it include tests? (Required)Yes5️⃣ Please include a thorough description (including small code snippets if possible) of the improvement and reasons why it's useful.These changes will improve memory usage. You can see the benchmark results here:// ...

```
