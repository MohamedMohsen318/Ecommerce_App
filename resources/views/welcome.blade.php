@extends('layouts.dashboard')

@section('title', 'Dashboard | ' . config('app.name', 'Ecommerce App'))
@section('page_title', 'Dashboard')
@section('page_description', 'A stable overview for store activity, orders, customers, and revenue.')

@section('actions')
    <button class="btn btn-primary" type="button">New order</button>
@endsection

@push('styles')
    <style>
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 18px;
        }

        .stat,
        .panel,
        .table-panel {
            background: #ffffff;
            border: 1px solid #e4e8f0;
            border-radius: 8px;
            box-shadow: 0 10px 28px rgba(16, 24, 39, .05);
        }

        .stat {
            min-height: 132px;
            padding: 18px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .stat-label {
            color: #697386;
            font-size: 14px;
            font-weight: 700;
        }

        .stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            display: grid;
            place-items: center;
            color: #ffffff;
            font-weight: 800;
        }

        .stat strong {
            display: block;
            margin-top: 14px;
            font-size: 30px;
            line-height: 1;
        }

        .stat small {
            color: #0a6f67;
            font-weight: 800;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.55fr) minmax(320px, .95fr);
            gap: 18px;
            align-items: start;
        }

        .panel {
            padding: 20px;
        }

        .panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 18px;
        }

        .panel h2,
        .table-panel h2 {
            margin: 0;
            font-size: 18px;
        }

        .panel p {
            margin: 4px 0 0;
            color: #697386;
            line-height: 1.5;
        }

        .chart {
            height: 260px;
            display: grid;
            grid-template-columns: repeat(7, minmax(30px, 1fr));
            gap: 12px;
            align-items: end;
            padding-top: 20px;
            border-top: 1px solid #edf0f5;
        }

        .bar {
            min-height: 38px;
            border-radius: 8px 8px 0 0;
            background: linear-gradient(180deg, #0f8f83, #0a6f67);
            display: flex;
            align-items: end;
            justify-content: center;
            color: white;
            font-size: 12px;
            font-weight: 800;
            padding-bottom: 8px;
        }

        .quick-list {
            display: grid;
            gap: 12px;
        }

        .quick-item {
            display: grid;
            grid-template-columns: 42px minmax(0, 1fr) auto;
            gap: 12px;
            align-items: center;
            padding: 12px;
            border: 1px solid #edf0f5;
            border-radius: 8px;
        }

        .quick-badge {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            display: grid;
            place-items: center;
            background: #f0f8f7;
            color: #0a6f67;
            font-weight: 900;
        }

        .quick-item strong {
            display: block;
            overflow-wrap: anywhere;
        }

        .quick-item span {
            color: #697386;
            font-size: 13px;
        }

        .pill {
            padding: 6px 9px;
            border-radius: 999px;
            background: #f4f6f9;
            color: #4b5565;
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
        }

        .table-panel {
            margin-top: 18px;
            overflow: hidden;
        }

        .table-head {
            padding: 18px 20px;
            border-bottom: 1px solid #e4e8f0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 14px 20px;
            border-bottom: 1px solid #edf0f5;
            text-align: left;
            white-space: nowrap;
        }

        th {
            color: #697386;
            font-size: 12px;
            text-transform: uppercase;
        }

        td {
            font-weight: 600;
        }

        tr:last-child td { border-bottom: 0; }

        .status {
            display: inline-flex;
            align-items: center;
            min-height: 26px;
            padding: 0 9px;
            border-radius: 999px;
            background: #e9fbf7;
            color: #075f57;
            font-size: 12px;
            font-weight: 800;
        }

        .status.warn {
            background: #fff5e6;
            color: #93560b;
        }

        .table-scroll {
            overflow-x: auto;
        }

        @media (max-width: 1060px) {
            .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .dashboard-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 620px) {
            .stats-grid { grid-template-columns: 1fr; }
            .chart { gap: 8px; height: 220px; }
            .quick-item { grid-template-columns: 38px minmax(0, 1fr); }
            .quick-item .pill { grid-column: 2; width: fit-content; }
        }
    </style>
@endpush

@section('content')
    <div class="stats-grid">
        <article class="stat">
            <div class="stat-top">
                <span class="stat-label">Revenue</span>
                <span class="stat-icon" style="background:#0f8f83">$</span>
            </div>
            <div>
                <strong>$24,860</strong>
                <small>+12.5% this week</small>
            </div>
        </article>

        <article class="stat">
            <div class="stat-top">
                <span class="stat-label">Orders</span>
                <span class="stat-icon" style="background:#3b82f6">#</span>
            </div>
            <div>
                <strong>1,248</strong>
                <small>184 pending</small>
            </div>
        </article>

        <article class="stat">
            <div class="stat-top">
                <span class="stat-label">Customers</span>
                <span class="stat-icon" style="background:#f59f38">C</span>
            </div>
            <div>
                <strong>8,932</strong>
                <small>321 new</small>
            </div>
        </article>

        <article class="stat">
            <div class="stat-top">
                <span class="stat-label">Conversion</span>
                <span class="stat-icon" style="background:#e85d75">%</span>
            </div>
            <div>
                <strong>4.8%</strong>
                <small>Healthy traffic</small>
            </div>
        </article>
    </div>

    <div class="dashboard-grid">
        <section class="panel">
            <div class="panel-head">
                <div>
                    <h2>Weekly sales</h2>
                    <p>Orders and revenue are ready for the next ecommerce pages.</p>
                </div>
                <span class="pill">Last 7 days</span>
            </div>

            <div class="chart" aria-label="Weekly sales chart">
                <div class="bar" style="height:42%">Sat</div>
                <div class="bar" style="height:58%">Sun</div>
                <div class="bar" style="height:47%">Mon</div>
                <div class="bar" style="height:72%">Tue</div>
                <div class="bar" style="height:64%">Wed</div>
                <div class="bar" style="height:86%">Thu</div>
                <div class="bar" style="height:78%">Fri</div>
            </div>
        </section>

        <aside class="panel">
            <div class="panel-head">
                <div>
                    <h2>Today</h2>
                    <p>Important work waiting for the store team.</p>
                </div>
            </div>

            <div class="quick-list">
                <div class="quick-item">
                    <span class="quick-badge">18</span>
                    <span><strong>Orders to review</strong><span>Payment and shipping checks</span></span>
                    <span class="pill">Now</span>
                </div>
                <div class="quick-item">
                    <span class="quick-badge">7</span>
                    <span><strong>Low stock products</strong><span>Inventory needs attention</span></span>
                    <span class="pill">Stock</span>
                </div>
                <div class="quick-item">
                    <span class="quick-badge">12</span>
                    <span><strong>Support messages</strong><span>Customer questions open</span></span>
                    <span class="pill">Inbox</span>
                </div>
            </div>
        </aside>
    </div>

    <section class="table-panel">
        <div class="table-head">
            <h2>Recent orders</h2>
        </div>

        <div class="table-scroll">
            <table>
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#EC-1048</td>
                        <td>Mona Hassan</td>
                        <td>$248.00</td>
                        <td><span class="status">Paid</span></td>
                        <td>May 29, 2026</td>
                    </tr>
                    <tr>
                        <td>#EC-1047</td>
                        <td>Ahmed Nabil</td>
                        <td>$96.50</td>
                        <td><span class="status warn">Pending</span></td>
                        <td>May 29, 2026</td>
                    </tr>
                    <tr>
                        <td>#EC-1046</td>
                        <td>Sara Ali</td>
                        <td>$412.20</td>
                        <td><span class="status">Shipped</span></td>
                        <td>May 28, 2026</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection
