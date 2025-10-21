---
config:
  layout: dagre
---
flowchart TD
 subgraph Legend["Legend / Key"]
    direction LR
        UA["User Interaction"]
        SR["Server-Side Action"]
        RC["RoleManager Transition"]
        SC["Secret Validation Check"]
        ER["Error Handling"]
        WF["WS Form Interaction"]
  end
    ST["Start"] --> Q1{"Has Account?"}
    Q1 -- No --> CA1["WS Form: Enter Email to Begin Registration"]
    Q1 -- Yes --> LG1["WS Form: Log In Form"]
    CA1 --> CA2["User Receives Email Verification Link"]
    CA2 --> CA3["User Clicks Link in Email"]
    CA3 --> CA4["WS Form: Complete Account Details (Name, DOB, Password)"]
    CA4 --> CA5["WS Form: Account Created Successfully"]
    CA5 --> CA6["Redirect to Login Screen"]
    CA6 --> LG1
    LG1 --> FP1@{ label: "Click 'Forgot Password?'" } & A["User Dashboard"]
    FP1 --> FP2["WS Form: Enter Email to Reset Password"]
    FP2 --> FP3["User Receives Password Reset Email"]
    FP3 --> FP4["User Clicks Reset Link in Email"]
    FP4 --> FP5["WS Form: Reset Password Form"]
    FP5 --> FP6["Password Reset Successful"]
    FP6 --> FP7["Redirect to Log In Form"]
    FP7 --> LG1
    A --> B@{ label: "Click 'Liquidate Your Gift Card Now'" }
    B --> C["Hidden Fields Captured (Name, DOB, Email, IP, etc.)"]
    C --> D["Federal Limit Policy Check"]
    D -- Limits Exceeded --> E1["Error: Limit Exceeded"]
    E1 --> E2["Calculate Next Eligible Date & Amount"]
    E2 --> E3["Display Message w/ Date & Amount"]
    E3 --> R1["RoleManager: Revert to Subscriber"]
    R1 --> R2["Redirect to Dashboard"]
    D -- Within Limits --> F1["WS Form: Gift Card Type Selection"]
    F1 -- Visa/Mastercard/Amex/Discover --> F2["Begin Plaid OAuth → Bank Account Linking"]
    F1 -- Other Gift Cards --> F3["Error: Unsupported Gift Card Type"]
    F3 --> R2
    F2 --> SC1["Secret Validation Check #1"]
    SC1 -- Failed --> ER1["Error: Secret Validation Failed"]
    ER1 --> R1
    SC1 -- Passed --> G["Plaid Modal: Bank Selection & Authentication"]
    G --> G1["Plaid Modal Result"]
    G1 -- Exit --> ER2["User Cancelled - Reset Status"]
    ER2 --> R1
    G1 -- Error/Cancel --> ER3["Handle Plaid Error"]
    ER3 --> ER4["Error Type"]
    ER4 -- Temporary --> RETRY1["Show Retry Option"]
    RETRY1 --> F2
    ER4 -- Bank Not Supported --> ER5["Bank Compatibility Error"]
    ER5 --> R1
    ER4 -- Auth Failed --> ER6["Authentication Error + Retry"]
    ER6 --> F2
    G1 -- Success --> H["RTP/FedNow Capability Check"]
    H --> H1{"Bank Compatible?"}
    H1 -- No --> ER7["Bank Incompatibility Error"]
    ER7 --> R1
    H1 -- Yes --> I["Plaid Identity Verifier"]
    I --> SC2["Secret Validation Check #2"]
    SC2 -- Failed --> ER8["Error: Secret Validation Failed"]
    ER8 --> R1
    SC2 -- Passed --> J["RoleManager: Plaid User → Transaction User"]
    J --> K["WS Form: Enter Gift Card Amount"]
    K --> K1["Server-Side Payout Offer Calculation"]
    K1 --> K2@{ label: "Click 'I Accept Offer & Agree to Terms'" }
    K2 --> SC3["Secret Validation Check #3"]
    SC3 -- Failed --> ER9["Error: Secret Validation Failed"]
    ER9 --> R1
    SC3 -- Passed --> L["Authorize.Net Accept.js Modal Appears"]
    L --> L1@{ label: "User Inputs Card Info + Clicks 'Pay Now'" }
    L1 --> M["Authorize & Capture Transaction"]
    M -- Success --> N["RoleManager: Transaction User → PAYMENT"]
    N --> SC4["Secret Validation Check #4"]
    SC4 -- Failed --> ER10["Error: Secret Validation Failed"]
    ER10 --> R1
    SC4 -- Passed --> O["PayoutManager: Calculate Final Net Payout"]
    O --> P["Initiate RTP/FedNow Payout via Plaid"]
    P --> SC5["Secret Validation Check #5"]
    SC5 -- Failed --> ER11["Error: Secret Validation Failed"]
    ER11 --> R1
    SC5 -- Passed --> Q["Transaction Complete Notification"]
    Q --> R["RoleManager: PAYMENT → Subscriber"]
    R --> S["Display Success Dashboard"]
    S --> END["End"]
    M -- Declined --> M1["Handle Payment Declined"]
    M1 --> M2{"Retry Allowed?"}
    M2 -- Yes --> RETRY2["Show Retry Option"]
    RETRY2 --> L
    M2 -- No --> ER12["Final Payment Error"]
    ER12 --> R1
    M -- Error --> M3["Handle Payment Error"]
    M3 --> L
    M -- Cancel --> M4["User Cancelled Payment"]
    M4 --> R1
    ST@{ shape: sm-circ}
    END@{ shape: dbl-circ}
     UA:::userAction
     SR:::serverAction
     RC:::roleChange
     SC:::secretCheck
     ER:::errorNode
     WF:::wsformNode
     CA1:::wsformNode
     LG1:::wsformNode
     CA2:::userAction
     CA3:::userAction
     CA4:::wsformNode
     CA5:::wsformNode
     CA6:::serverAction
     FP1:::wsformNode
     A:::userAction
     FP2:::wsformNode
     FP3:::userAction
     FP4:::userAction
     FP5:::wsformNode
     FP6:::wsformNode
     FP7:::wsformNode
     D:::serverAction
     E1:::errorNode
     E2:::serverAction
     E3:::userAction
     R1:::roleChange
     R2:::userAction
     F1:::wsformNode
     F2:::userAction
     F3:::errorNode
     SC1:::secretCheck
     ER1:::errorNode
     G:::userAction
     G1:::userAction
     ER2:::errorNode
     ER3:::errorNode
     ER4:::serverAction
     RETRY1:::userAction
     ER5:::errorNode
     ER6:::errorNode
     H:::serverAction
     H1:::userAction
     ER7:::errorNode
     I:::serverAction
     SC2:::secretCheck
     ER8:::errorNode
     J:::roleChange
     K:::wsformNode
     K1:::wsformNode
     K2:::wsformNode
     SC3:::secretCheck
     ER9:::errorNode
     L:::userAction
     L1:::userAction
     M:::serverAction
     N:::roleChange
     SC4:::secretCheck
     ER10:::errorNode
     O:::serverAction
     P:::serverAction
     SC5:::secretCheck
     ER11:::errorNode
     Q:::serverAction
     R:::roleChange
     S:::userAction
     M1:::errorNode
     M2:::userAction
     RETRY2:::userAction
     ER12:::errorNode
     M3:::errorNode
     M4:::errorNode
    classDef userAction fill:#eef,stroke:#4472c4,stroke-width:2px
    classDef roleChange fill:#d9f2ff,stroke:#00aaff,stroke-width:2px
    classDef serverAction fill:#fff2cc,stroke:#e69900,stroke-width:2px
    classDef secretCheck fill:#e6e6fa,stroke:#8a2be2,stroke-width:2px
    classDef errorNode fill:#ffd6d6,stroke:#cc0000,stroke-width:2px
    classDef wsformNode fill:#d0f0f0,stroke:#009999,stroke-width:2px
