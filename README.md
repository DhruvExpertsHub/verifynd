# verifynd

Security checks for plain PHP + MySQL projects: the XAMPP-and-tutorials
style that most student and small-business sites are built in.

verifynd looks for the mistakes these projects keep making, such as SQL
built by pasting user input, database errors shown to visitors, login
pages with no attempt limit, and forms without CSRF protection. It then
explains each finding in plain English, with the usual fix.

> **Status: early development.** Not ready for use yet. Rules are being
> written and tested; see [docs/RULES.md](docs/RULES.md) for what is planned.

## How it works
- Rules run on [Opengrep](https://github.com/opengrep/opengrep), a free,
  open-source code scanner (LGPL-2.1). They use the Semgrep rule format,
  so they also run on Semgrep.
- Every rule ships with a test file that proves it catches the mistake
  and ignores the safe version.
- Results come out as SARIF (the standard format GitHub reads) and as one
  readable HTML report.

## Planned
- A GitHub Action you can add to any repository in a few lines
- A one-command local run
- Published accuracy numbers (how often it is right, and how often it
  raises a false alarm)

## Licence
MIT. See [LICENSE](LICENSE).
