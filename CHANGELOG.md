# Changelog

All notable changes to **verifynd** are recorded here, newest first.
Format: [Keep a Changelog](https://keepachangelog.com/en/1.1.0/).
Versions follow [Semantic Versioning](https://semver.org/).

## [Unreleased]

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
