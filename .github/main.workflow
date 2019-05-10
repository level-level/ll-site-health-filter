workflow "Test" {
  on = "push"
  resolves = ["test"]
}

action "install" {
  uses = "docker://composer:1.8"
  runs = "composer install"
}

action "test" {
  uses = "docker://composer:1.8"
  runs = "composer test"
  needs = ["install"]
}
