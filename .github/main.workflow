workflow "Test" {
  on = "push"
  resolves = ["docker://composer:1.8"]
}

action "docker://composer:1.8" {
  uses = "docker://composer:1.8"
  runs = "composer install"
}
