# SuiteCRM Fundraising Extension

A lightweight, native-first fundraising and donor management extension for **SuiteCRM 8.x** (and backward-compatible with **SuiteCRM 7.x**). Rather than duplicating core CRM tables, this extension extends standard CRM modules (`Contacts`, `Accounts`, `Campaigns`, and `Opportunities`) and introduces three focused ledger and commitment modules: **Donations (`fr_Donations`)**, **Funds (`fr_Funds`)**, and **Pledges (`fr_Pledges`)**.

---

## Features

* **Hybrid Native + Custom Architecture:** Maps standard CRM entities to nonprofit workflows while keeping gift transactions, restricted fund accounting, and recurring pledges isolated in dedicated tables.
* **Restricted & Unrestricted Fund Accounting (`fr_Funds`):** Track General Ledger (GL) account numbers, fund codes, restriction status, target amounts, and live total received rollups.
* **Recurring & Multi-Year Commitments (`fr_Pledges`):** Manage monthly, quarterly, and annual sustainers, installment amounts, remaining balances, and external payment gateway subscription IDs.
* **Idempotent Gift Ledger (`fr_Donations`):** Enforce unique payment gateway `transaction_id` indexing to prevent duplicate records during webhook retries, plus support for tax-deductible split amounts and soft-credit donor attribution.
* **Automated Donor & Campaign Rollups:** Logic hooks and Symfony services recalculate `lifetime_giving_c`, `largest_gift_c`, `last_gift_date_c`, donor status tiers, and campaign/fund totals in real time.
* **Scheduled Donor Stewardship:** Automated jobs flag lapsed donors, send upcoming pledge reminders, and batch annual PDF tax receipts.
* **Secure Webhook Ingestion:** Signature-verified Symfony webhook controller for ingesting Stripe/payment gateway events without storing raw cardholder data in SuiteCRM.

---

## Data Model Overview

### Extended Native Modules
| Module | Fundraising Role | Key Custom Fields |
| :--- | :--- | :--- |
| **Contacts** | Individual Donors | `donor_status_c`, `lifetime_giving_c`, `last_gift_date_c`, `largest_gift_c`, `tax_receipt_pref_c`, `anonymous_donor_c` |
| **Accounts** | Households, Foundations & Corporate Sponsors | `org_type_c`, `matching_gift_ratio_c`, `grant_cycle_c`, `lifetime_giving_c` |
| **Campaigns** | Fundraising Appeals & Events | `fundraising_goal_c`, `total_pledged_c`, `total_received_c`, `appeal_code_c` |
| **Opportunities** | Major Gifts & Grant Pipeline | `grant_deadline_c`, `installment_count_c` |

### Custom Modules
| Module | Table | Purpose |
| :--- | :--- | :--- |
| **`fr_Donations`** | `fr_donations` | Individual received gifts, payment methods, soft credits, and tax receipt timestamps. |
| **`fr_Funds`** | `fr_funds` | Chart of accounts / fund designations (`fund_code`, `gl_account_number`, `is_restricted`). |
| **`fr_Pledges`** | `fr_pledges` | Sustainer schedules and multi-year pledge commitments (`frequency`, `next_billing_date`, `balance_remaining`). |

### Entity Relationships
```text
Contacts (1) ──────────< (M) fr_Donations (M) >────────── (1) fr_Funds
   │                           │   │
   ├── (1:M) fr_Pledges ───────┘   └── (M:1) Campaigns
   │                               │
   └── (M:M) Accounts ─────────────┴── (M:1) Opportunities (Grants/Major Gifts)
