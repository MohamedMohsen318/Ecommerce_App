@extends('layouts.dashboard')

@section('auth_guard', 'admin')
@section('dashboard_route', 'admin.dashboard')
@section('logout_route', 'admin.logout')

@section('title', 'Admin Dashboard | ' . config('app.name', 'Ecommerce App'))
@section('page_title', 'Admin Dashboard')
@section('page_description', 'Monitor sales, orders, products, and customer activity from one workspace.')

@section('actions')
    <button class="btn" type="button">Export</button>
    <button class="btn btn-primary" type="button">New product</button>
@endsection

@push('styles')
    <style>
        .overview {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 18px;
        }

        .metric,
        .panel,
        .table-panel {
            background: #ffffff;
            border: 1px solid #dfe6ee;
            border-radius: 8px;
            box-shadow: 0 12px 30px rgba(24, 32, 47, .05);
        }

        .metric {
            min-height: 142px;
            padding: 18px;
            display: grid;
            gap: 18px;
        }

        .metric-head,
        .panel-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .metric-label {
            color: #687386;
            font-size: 14px;
            font-weight: 800;
        }

        .metric-icon {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            display: grid;
            place-items: center;
            color: #ffffff;
            font-weight: 900;
        }

        .metric strong {
            display: block;
            font-size: 30px;
            line-height: 1;
        }

        .metric small {
            display: block;
            margin-top: 8px;
            color: #0b5f59;
            font-weight: 800;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.5fr) minmax(320px, .95fr);
            gap: 18px;
            align-items: start;
        }

        .panel {
            padding: 20px;
        }

        .panel-head {
            margin-bottom: 18px;
        }

        .panel h2,
        .table-panel h2 {
            margin: 0;
            font-size: 18px;
        }

        .panel p {
            margin: 5px 0 0;
            color: #687386;
            line-height: 1.5;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            min-height: 28px;
            padding: 0 10px;
            border-radius: 999px;
            background: #f2f5f8;
            color: #4b5565;
            font-size: 12px;
            font-weight: 900;
            white-space: nowrap;
        }

        .chart {
            height: 268px;
            display: grid;
            grid-template-columns: repeat(7, minmax(30px, 1fr));
            gap: 12px;
            align-items: end;
            padding: 20px 0 4px;
            border-top: 1px solid #edf1f5;
        }

        .bar {
            min-height: 42px;
            border-radius: 8px 8px 0 0;
            background: linear-gradient(180deg, #0f766e, #0b5f59);
            display: flex;
            align-items: end;
            justify-content: center;
            color: white;
            font-size: 12px;
            font-weight: 900;
            padding-bottom: 8px;
        }

        .activity-list {
            display: grid;
            gap: 12px;
        }

        .activity-item {
            display: grid;
            grid-template-columns: 42px minmax(0, 1fr) auto;
            gap: 12px;
            align-items: center;
            padding: 12px;
            border: 1px solid #edf1f5;
            border-radius: 8px;
        }

        .activity-badge {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            display: grid;
            place-items: center;
            background: #e7f6f2;
            color: #0b5f59;
            font-weight: 900;
        }

        .activity-item strong {
            display: block;
            overflow-wrap: anywhere;
        }

        .activity-item span {
            color: #687386;
            font-size: 13px;
        }

        .table-panel {
            margin-top: 18px;
            overflow: hidden;
        }

        .table-head {
            padding: 18px 20px;
            border-bottom: 1px solid #dfe6ee;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .table-scroll {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 14px 20px;
            border-bottom: 1px solid #edf1f5;
            text-align: left;
            white-space: nowrap;
        }

        th {
            color: #687386;
            font-size: 12px;
            text-transform: uppercase;
        }

        td {
            font-weight: 700;
        }

        tr:last-child td { border-bottom: 0; }

        .status {
            display: inline-flex;
            align-items: center;
            min-height: 26px;
            padding: 0 9px;
            border-radius: 999px;
            background: #e7f6f2;
            color: #0b5f59;
            font-size: 12px;
            font-weight: 900;
        }

        .status.warn {
            background: #fff5e6;
            color: #93560b;
        }

        .status.info {
            background: #eaf1ff;
            color: #3157d5;
        }

        @media (max-width: 1060px) {
            .overview { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .dashboard-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 620px) {
            .overview { grid-template-columns: 1fr; }
            .chart { gap: 8px; height: 220px; }
            .activity-item { grid-template-columns: 38px minmax(0, 1fr); }
            .activity-item .pill { grid-column: 2; width: fit-content; }
        }
    </style>
@endpush

@section('content')
    <div class="overview">
        <article class="metric">
            <div class="metric-head">
                <span class="metric-label">Revenue</span>
                <span class="metric-icon" style="background:#0f766e">$</span>
            </div>
            <div>
                <strong>$24,860</strong>
                <small>+12.5% this week</small>
            </div>
        </article>

        <article class="metric">
            <div class="metric-head">
                <span class="metric-label">Orders</span>
                <span class="metric-icon" style="background:#3157d5">O</span>
            </div>
            <div>
                <strong>1,248</strong>
                <small>184 pending review</small>
            </div>
        </article>

        <article class="metric">
            <div class="metric-head">
                <span class="metric-label">Customers</span>
                <span class="metric-icon" style="background:#c27803">C</span>
            </div>
            <div>
                <strong>8,932</strong>
                <small>321 new accounts</small>
            </div>
        </article>

        <article class="metric">
            <div class="metric-head">
                <span class="metric-label">Stock alerts</span>
                <span class="metric-icon" style="background:#c0265c">!</span>
            </div>
            <div>
                <strong>27</strong>
                <small>7 products critical</small>
            </div>
        </article>
    </div>

    <div class="dashboard-grid">
        <section class="panel">
            <div class="panel-head">
                <div>
                    <h2>Weekly sales</h2>
                    <p>Revenue trend across the last seven days.</p>
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
                    <h2>Needs attention</h2>
                    <p>Admin work waiting for action today.</p>
                </div>
            </div>

            <div class="activity-list">
                <div class="activity-item">
                    <span class="activity-badge">18</span>
                    <span><strong>Orders to review</strong><span>Payment and shipping checks</span></span>
                    <span class="pill">Now</span>
                </div>
                <div class="activity-item">
                    <span class="activity-badge">7</span>
                    <span><strong>Low stock products</strong><span>Inventory needs attention</span></span>
                    <span class="pill">Stock</span>
                </div>
                <div class="activity-item">
                    <span class="activity-badge">12</span>
                    <span><strong>Support messages</strong><span>Customer questions open</span></span>
                    <span class="pill">Inbox</span>
                </div>
            </div>
        </aside>
    </div>

    <section class="table-panel">
        <div class="table-head">
            <h2>Recent orders</h2>
            <span class="pill">Live overview</span>
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
                        <td><span class="status info">Shipped</span></td>
                        <td>May 28, 2026</td>
                    </tr>
                    <tr>
                        <td>#EC-1045</td>
                        <td>Omar Adel</td>
                        <td>$74.00</td>
                        <td><span class="status">Paid</span></td>
                        <td>May 28, 2026</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection
