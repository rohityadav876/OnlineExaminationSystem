---
description: An overview on how we should write Approved Contorls
---

# Approved Controls

## Overview

**Approved controls** are used to verify whether a particular resource is approved to be get used, based on the values set in the approved policies. This document walks you through the steps to write `Approved Controls` for a mod. 

## Getting Started

To Get Started with Approved Controls you need to run few commands from `turbot cli` that will generate a template for you

```
$ turbot init -r <ResourceName> -c <controlType> -y
```

{% hint style="info" %}
 **-c or --c \(control\):** Specify the control to add for the mod  
**-r or --r \(resource\):** Specify the resource to add the controls to  
**-y \(yes\):** Execute initialization action without requiring confirmation
{% endhint %}

Lets run this command from your terminal

```text
$ turbot init -r topic -c approved -y
```

> Note: The above step creates a file named `approved.yml` under the resource directory. `approved.yml` is auto populated along with other package files. The changes need to be made in this file for the systematic execution of the mod program. **Please refer the below mentioned mod folder structure.**

```text
<modDir>/src/<resourceName>/control/approved.yml
```

 Now Lets go to generated file in `<modDir>/src/<resourceName>/control/approved.yml` and open it in VSCode and edit Mentioned in the following steps

### Editing the approved.yml

{% hint style="info" %}
Change the value of **AccountId** for all the test cases.
{% endhint %}

This is the Sample Code Snippet for you from one of the several test case

```text
description: ok if multiple approved regions
      input:
        item:
          Aws:
            AccountId: TEST ACCOUNT ID //Change this to 492552618977
            RegionName: us-west-2
        approved: "Check: Approved"
        approvedUsage: true
        approvedRegions:
          - us-west-2
          - us-west-1
        regions:
          - us-west-2
          - us-west-1
      expected:
        control:
          state: ok
```

## Testing the Approved Controls

Since the Approved, CMDB and Discovery controls follow similar methodology for testing, we have an independent wiki page that covers the topic. Kindly refer the below mentioned link to know about the process of testing the controls. [**Testing Control Types**](https://github.com/turbotio/turbot-mods/wiki/Testing---Control-Types)\*\*\*\*

