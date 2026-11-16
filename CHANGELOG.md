# Changelog

All notable changes to **verifynd** are recorded here, newest first.
Format: [Keep a Changelog](https://keepachangelog.com/en/1.1.0/).
Versions follow [Semantic Versioning](https://semver.org/).

## [Unreleased]

### 2026-11-16 — First rules: errors shown to visitors (family #11)

**Added**
- `rules/php/error-disclosure.yaml`: four rules. Two taint rules follow
  database error text (`mysqli_error()`, `$conn->error`) and caught
  exception messages through variables to `echo`, `die`, `exit` and
  `print`; two pattern rules flag `display_errors` switched on and
  `phpinfo()` left in.
- `rules/php/error-disclosure.php`: 20 test cases (14 must be flagged,
  6 must not), including common tutorial lines.

**Changed**
- `docs/RULES.md`: family #11 marked Tested.

### 2026-11-16 — Research-backed rule catalogue

**Added**
- `docs/RULES.md`: the catalogue of 19 rule families in priority order,
  ranked by how common each flaw is in tutorial-style PHP, how often it
  is exploited, and how reliably a rule can catch it. Each entry has the
  vulnerable and safe code, the detection approach and its sources, plus
  a manual checklist for what rules cannot see.

### 2026-11-03 — Project set up

**Added**
- `README.md`: what verifynd is, how it will work, and its status.
- `LICENSE`: MIT.
- `docs/RULES.md`: placeholder for the catalogue of mistakes verifynd
  will look for.
- `rules/`, `report/`: folders for the rules and the report builder.
